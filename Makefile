repoversion=$(shell LANG=C aptitude show ce-phoenix | grep Version: | awk '{print $$2}')
nextversion=$(shell echo $(repoversion) | perl -ne 'chomp; print join(".", splice(@{[split/\./,$$_]}, 0, -1), map {++$$_} pop @{[split/\./,$$_]}), "\n";')

clean:
	rm -rf vendor composer.lock db/*.sqlite src/*/*dataTables*

migration:
	./vendor/bin/phinx migrate -c ./phinx-adapter.php

autoload:
	composer update

demodata:
	./vendor/bin/phinx seed:run -s Phoenix -s Demodata -s Cz -c ./phinx-adapter.php
	./vendor/bin/phinx migrate -c ./phinx-adapter.php

adminreset:
	./vendor/bin/phinx seed:run -s ResetAdmin -c ./phinx-adapter.php

newmigration:
	read -p "Enter CamelCase migration name : " migname ; ./vendor/bin/phinx create $$migname -c ./phinx-adapter.php

newseed:
	read -p "Enter CamelCase seed name : " migname ; ./vendor/bin/phinx seed:create $$migname -c ./phinx-adapter.php

dbreset:
	sudo rm -f db/multiflexibee.sqlite
	echo > db/multiflexibee.sqlite
	chmod 666 db/multiflexibee.sqlite
	chmod ugo+rwX db

demo: dbreset migration demodata

hourly:
	cd lib; php -f executor.php h
daily:
	cd lib; php -f executor.php d
monthly:
	cd lib; php -f executor.php m

postinst:
	DEBCONF_DEBUG=developer /usr/share/debconf/frontend /var/lib/dpkg/info/ce-phoenix.postinst configure $(nextversion)

redeb:
	 sudo apt -y purge ce-phoenix; rm ../ce-phoenix_*_all.deb ; debuild -us -uc ; sudo gdebi  -n ../ce-phoenix_*_all.deb ; sudo apache2ctl restart

deb:
	debuild-pbuilder


dimage: deb
	docker container stop $(docker container ls -q --filter name=ce-phoenix*)
	rm -f deb/* ; mv ../ce-phoenix*.deb deb
	cd deb ; dpkg-scanpackages . /dev/null | gzip -9c > Packages.gz ; cd ..
	docker build -t purehtml/ce-phoenix .

drun:
	docker run  -dit --name ce-phoenix -p 8080:80 purehtml/ce-phoenix
	firefox http://localhost:8080/ce-phoenix?login=demo\&password=demo


vagrant: deb
	vagrant destroy -f
	mkdir -p deb
	debuild -us -uc
	mv ../phoenix-cart*$(currentversion)_all.deb deb
	cd deb ; dpkg-scanpackages . /dev/null | gzip -9c > Packages.gz; cd ..
	vagrant up
	firefox http://localhost:8080/ce-phoenix?login=demo\&password=demo

release:
	echo Release v$(nextversion)
	docker build -t purehtml/ce-phoenix:$(nextversion) .
	dch -v $(nextversion) `git log -1 --pretty=%B | head -n 1`
	debuild -i -us -uc -b
	git commit -a -m "Release v$(nextversion)"
	git tag -a $(nextversion) -m "version $(nextversion)"
	docker push purehtml/ce-phoenix:$(nextversion)
	docker push purehtml/ce-phoenix:latest


