Diploma thesis
=================

Steps to setup project:
-----------------

1. Install Git
  1. Linux - installation based on distribution https://git-scm.com/download/linux
  2. Windows - download and install package from https://gitforwindows.org/ 
2. Install Docker & Docker-compose
  1. Linux - installation based on distribution https://docs.docker.com/engine/install/, see "Installation per distro" left menu
  2. Windows - download and install package from https://docs.docker.com/desktop/windows/install/
3. Clone git repository into PC
  1. Open Terminal
    1. Linux - terminal
    2. Windows - Windows PowerShell
  2. Write `git clone https://github.com/Plyshak/diploma-thesis.git thesis`
  3. Write `cd thesis`
  4. Run initialization script
    1. Linux - `./init.sh`
    2. Windows - `./init-win.sh`
  5. Open `http://localhost` in browser

Success instalation of Git and Docker can be confirmed in terminal:
1. Git - Write `git --version`
2. Docker - Write `docker --version`
Both commands either show installed version or error, that command is not recognised.
