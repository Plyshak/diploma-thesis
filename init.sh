echo 'Initializing project ...'

echo 'Starting web services ...'
docker-compose up -d --build --force-recreate
echo 'Done.'

echo 'Installing dependencies ...'
docker exec -it php-apache bash -c "cd ..; composer install"
echo 'Done.'

echo 'Fixing permissions...'
chmod 777 . -R
echo 'Done.'

echo 'Web service ready and running.'
echo 'All done.'

echo 'Visit http://localhost to see project.'

pause
