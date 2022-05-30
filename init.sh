echo 'Initializing project ...'

echo 'Starting web services ...'
docker-compose up -d
echo 'Done.'

echo 'Installing dependencies ...'
docker exec -it php-apache bash -c "cd ..; composer install"
echo 'Done.'

echo 'Web service ready and running.'
echo 'All done.'

echo 'Visit http://localhost to open project.'