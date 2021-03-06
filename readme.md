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

??esky: Diplomov?? pr??ce
=================

Varov??n?? - Program Docker nejde spr??vn?? nastavit pro OS Windows HOME edition. Je pot??eba m??t Windows PRO edici. P????padn?? nastaven?? HOME verze by bylo velmi ??asov?? n??ro??n?? a problematick??.

Kroky pro spu??t??n?? webov??ho prost??ed??:
-----------------

1. Instalace programu Git
    1. Linux - instalace podle distribuce z https://git-scm.com/download/linux
    2. Windows - st??hnout a nainstalovat bal????ek z https://gitforwindows.org/ 
2. Instalace programu Docker & Docker-compose
    1. Linux - instalace podle distribuce z https://docs.docker.com/engine/install/, v lev??m menu "Installation per distro" vybrat distribuci
    2. Windows - st??hnout a nainstalovat bal????ek z https://docs.docker.com/desktop/windows/install/
       1. P??i instalaci je pot??eba od??krknout mo??nost "Use WSL2 instead of HyperV" - Pokud by tato mo??nost byla za??krknut??, bylo by pot??eba pro ??sp????n?? spu??t??n?? webov?? aplikace manu??ln?? doinstalovat spoustu z??vislost?? pro program Docker.
       2. V p????pad??, ??e se nainstaluje program Docker s WSL2, objev?? se hl????ka "Installation of WSL2 is incomplete" -> doporu??uji v ten okam??ik odinstalovat cel?? program a nainstalovat ho znovu bez WSL2
       3. Po ??sp????n?? instalaci, pokud by program Docker hl??sil, ??e se pr??b????n?? zap??n?? a vyp??n??, je pot??eba kliknout pomoc?? prav??ho tla????tka my??i na ikonu programu v prav?? ????sti li??ty hlavn??ho panelu a vybrat mo??nost `Switch to Windows Containers...` -> N??sledn?? potvrd???? pomoc?? tla????tka `Switch` ve vyskakovac??m okn??. Aplikace se n??sledn?? zav??e. Po op??tovn??m otev??en?? aplikace by se jej?? stav m??l zastavit bu?? na "running" nebo "stopped". Pokud se tak stane, pomoc?? stejn??ho postupu p??epneme zp??tky na Linuxov?? kontejnery.
3. St??hnout git repozit???? aplikace do PC
    1. Otev????t p????kazovou ????dku
        1. Linux - termin??l
        2. Windows - Windows PowerShell
    2. Napi??te `git clone https://github.com/Plyshak/diploma-thesis.git thesis` a tla????tkem enter potvr??te
    3. Napi??te `cd thesis` a tla????tkem enter potvr??te
    4. Spus??te inicializa??n?? p????kaz
        1. Linux - `. ./init.sh`
        2. Windows - `./init-win.sh`
    5. Otev??ete `http://localhost` v prohl????e??i

??sp????n?? instalce program?? Git a Docker m????e b??t zkontrolov??na v p????kazov?? ????dce pomoc?? p????kaz??:
1. Git - Napi??te `git --version` a tla????tkem enter potvr??te
2. Docker - Napi??te `docker --version` a tla????tkem enter potvr??te

Oba p????kazy by m??ly vypsat nainstalovanou verzi programu nebo vypsat chzbovou hl????ku, ??e p????kaz nebyl rozpozn??n.
Uk??zka ??sp????n?? kontroly instalace pomoc?? p????kaz??:

```
PS C:\Users\User> docker --version
Docker version 20.10.14, build a224086

PS C:\Users\User> git --version
git version 2.36.1.windows.1
```

