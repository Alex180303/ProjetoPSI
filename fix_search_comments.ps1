$ErrorActionPreference = 'Stop'
$files = Get-ChildItem "platAnimais\backend\models\*Search.php" -File
foreach ($f in $files) {
  $text = [System.IO.File]::ReadAllText($f.FullName)
  $base = [IO.Path]::GetFileNameWithoutExtension($f.Name)
  $model = $base -replace 'Search$',''
  $oldClass = "* $base represents the model behind the search form of ``common\models\$model``."
  $newClass = "* $base representa o modelo por tras do formulario de pesquisa de ``common\models\$model``."
  $text = $text.Replace($oldClass, $newClass)
  $oldClass2 = "* $base represents the model behind the search form of `common\models\$model`."
  $newClass2 = "* $base representa o modelo por tras do formulario de pesquisa de ``common\models\$model``."
  $text = $text.Replace($oldClass2, $newClass2)
  $text = $text.Replace('// bypass scenarios() implementation in the parent class', '// ignora a implementacao de scenarios() da classe pai')
  $text = $text.Replace('* Creates data provider instance with search query applied', '* Cria uma instancia do data provider com a query de pesquisa aplicada')
  $text = $text.Replace('// add conditions that should always apply here', '// adiciona condicoes que devem ser sempre aplicadas aqui')
  $text = $text.Replace('// uncomment the following line if you do not want to return any records when validation fails', '// descomente a linha seguinte se nao quiser devolver quaisquer registos quando a validacao falhar')
  $text = $text.Replace('* @param string|null $formName Form name to be used into `->load()` method.', '* @param string|null $formName Nome do formulario a utilizar no metodo `->load()`.')
  [System.IO.File]::WriteAllText($f.FullName, $text, [System.Text.UTF8Encoding]::new($false))
  Write-Output ("updated " + $f.FullName)
}
