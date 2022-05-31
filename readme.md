English: Diploma thesis
=================

Warrning - For Windows, this manual covers only Windows PRO version. For Windows HOME edition is needed to install virtual host with linux subszstem, which is very time consuming and not easily done.

Steps to setup project:
-----------------

1. Install Git
    1. Linux - installation based on distribution https://git-scm.com/download/linux
    2. Windows - download and install package from https://gitforwindows.org/ 
2. Install Docker & Docker-compose
    1. Linux - installation based on distribution https://docs.docker.com/engine/install/, see "Installation per distro" left menu
    2. Windows - download and install package from https://docs.docker.com/desktop/windows/install/
       1. Opt-out installation option "Use WSL2 instead of HyperV" - If this is marked, it will be necessary to manualy install all dependencies into Docker
       2. In case after installation prompt is showed with text "Installation of WSL2 is incomplete" -> it is adviced to uninstall Docker and install it again without the WSL2 feature
       3. After successfull installation, if Docker keeps starting and stopping, right click on Docker icon in right startup panel and select `Switch to Windows Containers...` -> Click `Switch` in prompt menu. After that the Docker should start up, then switch back to Linux containers via same instructions
3. Clone git repository into PC
    1. Open Terminal
        1. Linux - terminal
        2. Windows - Windows PowerShell
    2. Write `git clone https://github.com/Plyshak/diploma-thesis.git thesis`
    3. Write `cd thesis`
    4. Run initialization script
        1. Linux - `. ./init.sh`
        2. Windows - `./init-win.sh`
    5. Open `http://localhost` in browser

Success instalation of Git and Docker can be confirmed in terminal:
1. Git - Write `git --version`
2. Docker - Write `docker --version`

Both commands either show installed version or error, that command is not recognised.
Examples of success:

```
PS C:\Users\User> docker --version
Docker version 20.10.14, build a224086

PS C:\Users\User> git --version
git version 2.36.1.windows.1
```

Česky: Diplomová práce
=================

Varování - Program Docker nejde správně nastavit pro OS Windows HOME edition. Je potřeba mít Windows PRO edici. Případné nastavení HOME verze by bylo velmi časově náročné a problematické.

Kroky pro spuštění webového prostředí:
-----------------

1. Instalace programu Git
    1. Linux - instalace podle distribuce z https://git-scm.com/download/linux
    2. Windows - stáhnout a nainstalovat balíček z https://gitforwindows.org/ 
2. Instalace programu Docker & Docker-compose
    1. Linux - instalace podle distribuce z https://docs.docker.com/engine/install/, v levém menu "Installation per distro" vybrat distribuci
    2. Windows - stáhnout a nainstalovat balíček z https://docs.docker.com/desktop/windows/install/
       1. Při instalaci je potřeba odškrknout možnost "Use WSL2 instead of HyperV" - Pokud by tato možnost byla zaškrknutá, bylo by potřeba pro úspěšné spuštění webové aplikace manuálně doinstalovat spoustu závislostí pro program Docker.
       2. V případě, že se nainstaluje program Docker s WSL2, objeví se hláška "Installation of WSL2 is incomplete" -> doporučuji v ten okamžik odinstalovat celý program a nainstalovat ho znovu bez WSL2
       3. Po úspěšné instalaci, pokud by program Docker hlásil, že se průběžně zapíná a vypíná, je potřeba kliknout pomocí pravého tlačítka myši na ikonu programu v pravé části lišty hlavního panelu a vybrat možnost `Switch to Windows Containers...` -> Následně potvrdíš pomocí tlačítka `Switch` ve vyskakovacím okně. Aplikace se následně zavře. Po opětovném otevření aplikace by se její stav měl zastavit buď na "running" nebo "stopped". Pokud se tak stane, pomocí stejného postupu přepneme zpátky na Linuxové kontejnery.
3. Stáhnout git repozitář aplikace do PC
    1. Otevřít příkazovou řádku
        1. Linux - terminál
        2. Windows - Windows PowerShell
    2. Napište `git clone https://github.com/Plyshak/diploma-thesis.git thesis` a tlačítkem enter potvrďte
    3. Napište `cd thesis` a tlačítkem enter potvrďte
    4. Spusťte inicializační příkaz
        1. Linux - `. ./init.sh`
        2. Windows - `./init-win.sh`
    5. Otevřete `http://localhost` v prohlížeči

Úspěšní instalce programů Git a Docker může být zkontrolována v příkazové řádce pomocí příkazů:
1. Git - Napište `git --version` a tlačítkem enter potvrďte
2. Docker - Napište `docker --version` a tlačítkem enter potvrďte

Oba příkazy by měly vypsat nainstalovanou verzi programu nebo vypsat chzbovou hlášku, že příkaz nebyl rozpoznán.
Ukázka úspěšné kontroly instalace pomocí příkazů:

```
PS C:\Users\User> docker --version
Docker version 20.10.14, build a224086

PS C:\Users\User> git --version
git version 2.36.1.windows.1
```

