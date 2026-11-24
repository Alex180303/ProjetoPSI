$ErrorActionPreference = 'Stop'

function Is-TextFile([string]$path) {
  $ext = [IO.Path]::GetExtension($path).ToLower()
  $base = Split-Path $path -Leaf
  $ok = @('.php','.phtml','.js','.jsx','.ts','.tsx','.java','.kt','.kts','.xml','.yml','.yaml','.css','.scss','.less','.html','.htm','.sh','.bat','.cmd','.ps1','.sql','.gradle','.properties','.toml','.ini','.conf','.rb','.c','.cpp','.h','.vue')
  return ($ok -contains $ext) -or (@('Vagrantfile','Dockerfile','init','yii','yii_test','gradlew','Makefile') -contains $base)
}

function Should-SkipPath([string]$full) {
  $p = $full.ToLower()
  return ($p -match '\\vendor\\' -or $p -match '\\runtime\\' -or $p -match '\\\.git\\' -or $p -match '\\\.gradle\\' -or $p -match '\\\.idea\\' -or ($p -match '\\app\\' -and $p -match '\\build\\') -or $p -match '\\backend\\web\\assets\\' -or $p -match '\\frontend\\web\\assets\\' -or $p -match '\\frontend\\web\\template\\lib\\' -or $p -match '\\gradle\\wrapper\\' -or $p -match '\\node_modules\\')
}

function Is-CommentLine([string]$line, [string]$ext, [string]$base) {
  $t = $line.Trim()
  if (-not $t) { return $false }
  if (@('.php','.phtml','.js','.jsx','.ts','.tsx','.java','.kt','.kts','.css','.scss','.less','.sql','.gradle','.c','.cpp','.h','.vue') -contains $ext) {
    if ($t.StartsWith('//') -or $t.StartsWith('/*') -or $t.StartsWith('*') -or $t.Contains('<!--')) { return $true }
  }
  if ((@('.yml','.yaml','.sh','.properties','.toml','.ini','.conf','.rb') -contains $ext) -or (@('Vagrantfile','Dockerfile','init','yii','yii_test','gradlew','.gitignore','.gitattributes','.editorconfig','.bowerrc') -contains $base)) {
    if ($t.StartsWith('#') -or $t.StartsWith(';')) { return $true }
  }
  if (@('.bat','.cmd') -contains $ext) {
    if ($t -match '^(?i:rem\b|::)') { return $true }
  }
  if (@('.xml','.html','.htm','.svg') -contains $ext) {
    if ($t.Contains('<!--')) { return $true }
  }
  if ($t.StartsWith('#') -or $t.StartsWith('//') -or $t.StartsWith('/*') -or $t.StartsWith('*')) { return $true }
  return $false
}

$enWords = @(' the ',' and ',' for ',' with ',' from ',' this ',' that ',' will ',' should ',' must ',' can ',' cannot ',' not ',' only ',' all ',' each ',' any ',' into ',' when ',' if ',' else ',' return ',' returns ',' create ',' creates ',' update ',' updates ',' delete ',' deletes ',' display ',' displays ',' shows ',' show ',' used ',' use ',' using ',' default ',' example ',' note ',' please ',' check ',' checks ',' make sure ',' allows ',' allow ',' enable ',' enables ',' disable ',' disables ',' whether ',' required ',' optional ',' list ',' lists ',' get ',' gets ',' set ',' sets ',' add ',' adds ',' remove ',' removes ',' load ',' loads ',' save ',' saves ',' send ',' sends ',' generated ',' initialize ',' initializes ',' configure ',' configuration ',' request ',' response ',' user ',' users ',' password ',' login ',' logout ',' register ',' verify ',' resend ',' reset ',' token ',' email ',' message ',' error ',' errors ',' success ',' page ',' file ',' files ',' path ',' directory ',' class ',' classes ',' method ',' methods ',' function ',' functions ',' property ',' properties ',' parameter ',' parameters ',' throws ',' implementation ',' following ',' before ',' after ',' current ',' existing ',' available ',' either ',' both ',' instead ',' ensure ',' contains ',' value ',' values ',' name ',' names ',' type ',' types ',' data ',' object ',' objects ',' string ',' array ',' number ',' true ',' false ',' null ',' undefined ',' new ',' old ',' first ',' last ',' next ',' previous ',' based ',' specific ',' custom ',' main ',' simple ',' basic ',' additional ',' same ',' different ',' without ',' within ',' between ',' through ',' over ',' under ',' about ',' more ',' less ',' than ',' then ',' also ',' here ',' there ',' where ',' which ',' whose ',' been ',' being ',' have ',' has ',' had ',' does ',' did ',' done ',' these ',' those ',' their ',' them ',' they ',' your ',' you ',' our ',' we ',' its ')

$roots = @()
if (Test-Path 'platAnimais') { $roots += Get-ChildItem -Path 'platAnimais' -Recurse -File -ErrorAction SilentlyContinue }
if (Test-Path 'APP') { $roots += Get-ChildItem -Path 'APP' -Recurse -File -ErrorAction SilentlyContinue }
$roots += Get-ChildItem -Path '.' -File -ErrorAction SilentlyContinue

$results = @()
foreach ($f in $roots) {
  $full = $f.FullName
  if (Should-SkipPath $full) { continue }
  if (-not (Is-TextFile $full)) { continue }
  $ext = [IO.Path]::GetExtension($full).ToLower()
  $base = [IO.Path]::GetFileName($full)
  try { $lines = [System.IO.File]::ReadAllLines($full) } catch { continue }
  $fileHits = @()
  for ($i = 0; $i -lt $lines.Count; $i++) {
    $line = $lines[$i]
    if (-not (Is-CommentLine $line $ext $base)) { continue }
    $t = $line.Trim()
    if ($t -match '^\*\s*@(?:var|param|return|throws|property|property-read|property-write|method|inheritdoc|deprecated|since|see|link|author|license|package|psalm|phpstan|template|extends|implements|mixin|noinspection)\b') { continue }
    if ($t -match '^(//|#)\s*@') { continue }
    if ($t -match '^[\/\*#\-\s=!<>]+$') { continue }
    $lower = ' ' + ($t.ToLower() -replace "[^a-z0-9_'\-]+", ' ') + ' '
    $score = 0
    foreach ($w in $enWords) { if ($lower.Contains($w)) { $score++ } }
    if ($score -ge 2) {
      $sample = $t
      if ($sample.Length -gt 220) { $sample = $sample.Substring(0,220) }
      $fileHits += [PSCustomObject]@{ line = ($i+1); score = $score; text = $sample }
    }
  }
  if ($fileHits.Count -gt 0) {
    $results += [PSCustomObject]@{ file = $full; count = $fileHits.Count; samples = @($fileHits | Select-Object -First 12) }
  }
}

$results = $results | Sort-Object count -Descending
Write-Output ("FILES=" + $results.Count)
Write-Output ("TOTAL=" + (($results | Measure-Object -Property count -Sum).Sum))
foreach ($r in $results) {
  Write-Output ("### " + $r.count + " :: " + $r.file)
  foreach ($s in $r.samples) {
    Write-Output ("  L" + $s.line + " [" + $s.score + "] " + $s.text)
  }
}
