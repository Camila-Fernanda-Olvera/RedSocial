param(
    [switch]$NoPush
)

# Script para ejecutar la acción cuando el usuario envía "ejecutar"
# Comportamiento:
# - configura localmente user.name y user.email a 'vickyjuarez' / 'jvirginiamonserrat@gmail.com'
# - añade una línea temática a `wii/placeholder.txt` (por defecto)
# - hace commit con un mensaje seleccionado aleatoriamente de la lista temática
# - por defecto hace push; usar -NoPush para evitar el push

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$RepoRoot = Resolve-Path (Join-Path $ScriptDir "..")
Set-Location $RepoRoot

git config user.name "vickyjuarez"
git config user.email "jvirginiamonserrat@gmail.com"

$messages = @(
    "login: inicio de sesión",
    "login: cierre de sesión",
    "social: actualización de perfil",
    "social: nuevo seguidor",
    "login: recuperación de contraseña",
    "social: publicación compartida",
    "login: sesión iniciada",
    "social: conexión creada"
)

$Message = Get-Random -InputObject $messages

$File = Join-Path $RepoRoot "wii\placeholder.txt"
if (-not (Test-Path $File)) {
    New-Item -ItemType File -Path $File -Force | Out-Null
}

$Date = Get-Date -Format "yyyy-MM-dd HH:mm:ss"
$Line = "Commit automático: $Message - Fecha: $Date - Autor: vickyjuarez"
Add-Content -Path $File -Value $Line

Write-Output "Archivo modificado: $File"
Write-Output "Mensaje seleccionado: $Message"


git add $File
git commit -m "$Message"

if (-not $NoPush) {
    Write-Output "Push automático activado: haciendo push a origin main..."
    git push origin main
} else {
    Write-Output "Push desactivado por -NoPush."
}

Write-Output "Último commit:"; git log -1 --pretty=format:"%h %an <%ae> %s"
