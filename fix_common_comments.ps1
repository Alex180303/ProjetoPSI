$ErrorActionPreference = 'Stop'

function Should-Skip([string]$full) {
  $p = $full.ToLower()
  if ($p -match '\\vendor\\') { return $true }
  if ($p -match '\\runtime\\') { return $true }
  if ($p -match '\\\.git\\') { return $true }
  if ($p -match '\\\.gradle\\') { return $true }
  if ($p -match '\\\.idea\\') { return $true }
  if ($p -match '\\app\\' -and $p -match '\\build\\') { return $true }
  if ($p -match '\\backend\\web\\assets\\') { return $true }
  if ($p -match '\\frontend\\web\\assets\\') { return $true }
  if ($p -match '\\frontend\\web\\template\\lib\\') { return $true }
  if ($p -match '\\node_modules\\') { return $true }
  # skip third-party/minified and license-heavy files
  if ($p -like '*\frontend\web\template\css\bootstrap.min.css') { return $true }
  if ($p -like '*\app\gradlew') { return $true }
  if ($p -like '*\c3.php') { return $true }
  return $false
}

$replacements = @(
  @{ old = '// !!! insira uma chave secreta no seguinte (se estiver vazia) - isto e necessario para a validacao de cookies'; new = '// !!! insira uma chave secreta no seguinte (se estiver vazia) - isto e necessario para a validacao de cookies' },
  @{ old = '// configuration adjustments for ''dev'' environment'; new = '// ajustes de configuracao para o ambiente ''dev''' },
  @{ old = '// NOTA: Certifique-se de que este ficheiro nao esta acessivel quando implantado em producao'; new = '// NOTA: Certifique-se de que este ficheiro nao esta acessivel quando implantado em producao' },
  @{ old = '// adicione aqui codigo de bootstrap especifico para testes funcionais'; new = '// adicione aqui codigo de bootstrap especifico para testes funcionais' },
  @{ old = '// adicione aqui codigo de bootstrap especifico para testes unitarios'; new = '// adicione aqui codigo de bootstrap especifico para testes unitarios' },
  @{ old = '// adicione aqui codigo de bootstrap especifico para testes de aceitacao'; new = '// adicione aqui codigo de bootstrap especifico para testes de aceitacao' },
  @{ old = '# emula pedidos web e faz com que a aplicacao os processe.'; new = '# emula pedidos web e faz com que a aplicacao os processe.' },
  @{ old = '# Executa testes no navegador usando WebDriver ou PhpBrowser.'; new = '# Executa testes no navegador usando WebDriver ou PhpBrowser.' },
  @{ old = '# Se precisar de testes com WebDriver e PHPBrowser, crie uma suite separada.'; new = '# Se precisar de testes com WebDriver e PHPBrowser, crie uma suite separada.' },
  @{ old = '# ficheiro global do Codeception para executar testes de todas as aplicacoes'; new = '# ficheiro global do Codeception para executar testes de todas as aplicacoes' },
  @{ old = '<!-- Content Wrapper. Contem o conteudo da pagina -->'; new = '<!-- Content Wrapper. Contem o conteudo da pagina -->' },
  @{ old = '// o codigo de inicializacao personalizado vai aqui'; new = '// o codigo de inicializacao personalizado vai aqui' },
  @{ old = '* Classe de definicao do modulo da API'; new = '* Classe de definicao do modulo da API' },
  @{ old = '// envia todos os emails para um ficheiro por predefinicao.'; new = '// envia todos os emails para um ficheiro por predefinicao.' },
  @{ old = '// Tem de definir'; new = '// Tem de definir' },
  @{ old = '// e configurar um transporte para o mailer enviar emails reais.'; new = '// e configurar um transporte para o mailer enviar emails reais.' },
  @{ old = '// Exemplo de servidor SMTP:'; new = '// Exemplo de servidor SMTP:' },
  @{ old = '// Exemplo de DSN:'; new = '// Exemplo de DSN:' },
  @{ old = '// Ver: https://symfony.com/doc/current/mailer.html#using-built-in-transports'; new = '// Ver: https://symfony.com/doc/current/mailer.html#using-built-in-transports' },
  @{ old = '// Ou, se usar um servico de terceiros, consulte:'; new = '// Ou, se usar um servico de terceiros, consulte:' },
  @{ old = '# Este ficheiro e gerado por updateDaemonJvm'; new = '# Este ficheiro e gerado por updateDaemonJvm' },
  @{ old = '// Ficheiro de build de nivel superior onde pode adicionar opcoes de configuracao comuns a todos os subprojetos/modulos.'; new = '// Ficheiro de build de nivel superior onde pode adicionar opcoes de configuracao comuns a todos os subprojetos/modulos.' },
  @{ old = '<!-- Personalize aqui o seu tema claro. -->'; new = '<!-- Personalize aqui o seu tema claro. -->' },
  @{ old = '<!-- Personalize aqui o seu tema escuro. -->'; new = '<!-- Personalize aqui o seu tema escuro. -->' },
  @{ old = '* Exemplo de teste unitario local, que sera executado na maquina de desenvolvimento (host).'; new = '* Exemplo de teste unitario local, que sera executado na maquina de desenvolvimento (host).' },
  @{ old = '* Teste instrumentado, que sera executado num dispositivo Android.'; new = '* Teste instrumentado, que sera executado num dispositivo Android.' },
  @{ old = '// Contexto da aplicacao em teste.'; new = '// Contexto da aplicacao em teste.' },
  @{ old = '<!-- TODO: Use <include> e <exclude> para controlar o que e copiado em backup.'; new = '<!-- TODO: Use <include> e <exclude> para controlar o que e copiado em backup.' },
  @{ old = 'rem Defina a variavel GRADLE_EXIT_CONSOLE se precisar do codigo de retorno do _script_ em vez do'; new = 'rem Defina a variavel GRADLE_EXIT_CONSOLE se precisar do codigo de retorno do _script_ em vez do' },
  @{ old = 'rem codigo de retorno do _cmd.exe /c_!'; new = 'rem codigo de retorno do _cmd.exe /c_!' },
  @{ old = '## Este ficheiro *NAO* deve ser incluido em sistemas de controlo de versoes,'; new = '## Este ficheiro *NAO* deve ser incluido em sistemas de controlo de versoes,' },
  @{ old = '# pois contem informacoes especificas da sua configuracao local.'; new = '# pois contem informacoes especificas da sua configuracao local.' },
  @{ old = '# Localizacao do SDK. Isto e usado apenas pelo Gradle.'; new = '# Localizacao do SDK. Isto e usado apenas pelo Gradle.' },
  @{ old = '# Para personalizacao ao usar um sistema de controlo de versoes, leia o'; new = '# Para personalizacao ao usar um sistema de controlo de versoes, leia o' },
  @{ old = '# cabecalho da nota.'; new = '# cabecalho da nota.' },
  @{ old = '# Redirect everything that isn''t a real file to index.php'; new = '# Redireciona tudo o que nao for um ficheiro real para index.php' },
  @{ old = '* Envia o email de confirmacao ao utilizador.'; new = '* Envia o email de confirmacao ao utilizador.' }
)

$roots = @()
if (Test-Path 'platAnimais') { $roots += Get-ChildItem -Path 'platAnimais' -Recurse -File -ErrorAction SilentlyContinue }
if (Test-Path 'APP') { $roots += Get-ChildItem -Path 'APP' -Recurse -File -ErrorAction SilentlyContinue }
$roots += Get-ChildItem -Path '.' -File -ErrorAction SilentlyContinue

$changed = 0
foreach ($f in $roots) {
  $full = $f.FullName
  if (Should-Skip $full) { continue }
  $ext = [IO.Path]::GetExtension($full).ToLower()
  $base = [IO.Path]::GetFileName($full)
  $ok = @('.php','.phtml','.js','.jsx','.ts','.tsx','.java','.kt','.kts','.xml','.yml','.yaml','.css','.scss','.less','.html','.htm','.sh','.bat','.cmd','.ps1','.sql','.gradle','.properties','.toml','.ini','.conf','.rb','.c','.cpp','.h','.vue')
  $allowedNames = @('Vagrantfile','Dockerfile','init','yii','yii_test','gradlew','Makefile','.gitignore','.gitattributes','.editorconfig','.bowerrc')
  if (-not ($ok -contains $ext -or $allowedNames -contains $base)) { continue }
  try { $text = [System.IO.File]::ReadAllText($full) } catch { continue }
  $orig = $text
  foreach ($r in $replacements) {
    if ($text.Contains($r.old)) { $text = $text.Replace($r.old, $r.new) }
  }
  if ($text -ne $orig) {
    [System.IO.File]::WriteAllText($full, $text, [System.Text.UTF8Encoding]::new($false))
    $changed++
    Write-Output ("changed " + $full)
  }
}
Write-Output ("CHANGED_COUNT=" + $changed)
