all: psr2 server

server:
	php -S127.0.0.1:7692

psr2:
	 @for file in `find ./ -name \*.php`; do php-cs-fixer fix $$file --fixers=psr2; done

