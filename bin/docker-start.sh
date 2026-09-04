#!/bin/bash

function installGit(){
  [ -f /usr/bin/git ] && return 0;
  echo -e "Installing git ...\n"
  apt update -y &>/dev/null
  apt install git -y &> /dev/null
  [ $? -gt 0 ] && echo 'Failed to install git' && exit 1;
  return 0
}

function installComposer(){
  [ -f /bin/composer ] && return 0;

  echo -e "Installing composer ...\n"
  cd /
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
  php composer-setup.php && \
  php -r "unlink('composer-setup.php');"
  [ $? -gt 0 ] && echo 'Failed to install composer' && exit 1
  mv composer.phar /bin/composer
  chmod 755 /bin/composer
  return 0
}

function installDeps(){
  git config --global --add safe.directory /ipqs
  echo -e "Installing composer dependencies...\n"
  cd /ipqs && composer install
  [ $? -gt 0 ] && echo 'Failed to install composer dependencies' && exit 1
  ln -s /ipqs/bin/ipqs /bin
  return 0
}

installGit && \
installComposer && \
installDeps && \
/bin/ipqs \ &&
echo 'Run in your host ./bin/de ipqs to login into container, then run ipqs console'

tail -f /dev/null
