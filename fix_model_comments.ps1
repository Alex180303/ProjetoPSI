$ErrorActionPreference = 'Stop'
$paths = @(
 'platAnimais\common\models\Animal.php',
 'platAnimais\common\models\Adocao.php',
 'platAnimais\common\models\Raca.php',
 'platAnimais\common\models\Notificacao.php',
 'platAnimais\common\models\FichaClinica.php',
 'platAnimais\common\models\Especie.php',
 'platAnimais\common\models\Porte.php',
 'platAnimais\common\models\Perfil.php',
 'platAnimais\common\models\Desconto.php',
 'platAnimais\common\models\Associacao.php'
)
foreach ($p in $paths) {
  if (-not (Test-Path $p)) { Write-Output "skip $p"; continue }
  $text = [System.IO.File]::ReadAllText($p)
  $text = [regex]::Replace($text, '\* This is the model class for table "([^"]+)"\.', '* Esta e a classe de modelo para a tabela "$1".')
  $text = [regex]::Replace($text, '\* Gets query for \[\[([^\]]+)\]\]\.', '* Obtem a query para [[${1}]].')
  [System.IO.File]::WriteAllText($p, $text, [System.Text.UTF8Encoding]::new($false))
  Write-Output ("updated " + $p)
}
