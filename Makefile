build:
	docker build -f php/Dockerfile -t poker:latest --rm .
run:
	docker run -d -p 80:80 -v ./app:/var/www/app:rw -v ./apache_conf:/etc/apache2/sites-enabled -v ./logs:/var/log/apache2/poker --name poker poker:latest
stop: 
	docker container stop poker && docker container prune -f