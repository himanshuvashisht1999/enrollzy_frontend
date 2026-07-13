$files = Get-ChildItem "c:\xampp\htdocs\enrollzy_frontend\resources\views\*.blade.php" | Where-Object { $_.Name -ne 'welcome.blade.php' }
New-Item -ItemType Directory -Force -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\common"
New-Item -ItemType Directory -Force -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\layouts"

$indexContent = Get-Content -Raw -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\index.blade.php"

# Extract Head (contents only)
$headMatch = [regex]::Match($indexContent, '(?is)<head>(.*?)</head>')
if ($headMatch.Success) {
    Set-Content -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\common\head.blade.php" -Value $headMatch.Groups[1].Value.Trim()
}

# Extract Header (full tags)
$headerMatch = [regex]::Match($indexContent, '(?is)(<header.*?</header>)')
if ($headerMatch.Success) {
    Set-Content -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\common\header.blade.php" -Value $headerMatch.Groups[1].Value.Trim()
}

# Extract Footer (full tags)
$footerMatch = [regex]::Match($indexContent, '(?is)(<footer.*?</footer>)')
if ($footerMatch.Success) {
    Set-Content -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\common\footer.blade.php" -Value $footerMatch.Groups[1].Value.Trim()
}

# Extract Script
$scriptStartIdx = $indexContent.IndexOf('<script')
if ($scriptStartIdx -gt 0) {
    $scriptEndIdx = $indexContent.LastIndexOf('</body>')
    if ($scriptEndIdx -gt $scriptStartIdx) {
        $scriptContent = $indexContent.Substring($scriptStartIdx, $scriptEndIdx - $scriptStartIdx).Trim()
        Set-Content -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\common\script.blade.php" -Value $scriptContent
    }
}

$appBlade = @"
<!DOCTYPE html>
<html lang="en">
<head>
    @include('common.head')
</head>
<body>
    <div class="top-gradient-div"></div>
    @include('common.header')
    @yield('content')
    @include('common.footer')
    @include('common.script')
</body>
</html>
"@
Set-Content -Path "c:\xampp\htdocs\enrollzy_frontend\resources\views\layouts\app.blade.php" -Value $appBlade

foreach ($file in $files) {
    $c = Get-Content -Raw -Path $file.FullName
    
    $startIdx = $c.IndexOf('</header>')
    if ($startIdx -lt 0) { continue }
    $startIdx += 9 # Length of </header>
    
    $endIdx = $c.IndexOf('<footer')
    if ($endIdx -lt 0) {
        $endIdx = $c.IndexOf('<script')
    }
    
    if ($endIdx -gt $startIdx) {
        $inner = $c.Substring($startIdx, $endIdx - $startIdx).Trim()
        $newContent = "@extends('layouts.app')`n@section('content')`n" + $inner + "`n@endsection"
        Set-Content -Path $file.FullName -Value $newContent
    }
}
