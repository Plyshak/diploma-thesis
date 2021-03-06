echo 'Initializing project ...'

echo 'Starting web services ...'
docker-compose up -d --build --force-recreate
echo 'Done.'

echo 'Installing dependencies ...'
winpty docker exec -it php-apache bash -c "cd ..; composer install"
echo 'Done.'

echo 'Web service ready and running.'
echo 'All done.'

echo 'Visit http://localhost to see project.'

cmd /k