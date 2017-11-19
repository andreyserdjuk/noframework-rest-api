## ABOUT
REST api server without any framework, done for interview, not for reinventing the wheel.

## HOW TO RUN

```bash
cp ./app/config/params.yml.dist ./app/config/params.yml 
```
see its content, add needed credentials, then run php server:
```bash
php -S 127.0.0.1:8000 -t ./web
```
"books" resource is already hardcoded.  
There are 10 elements with id = 1..10.  
Try to get it:

```bash
# get one book
curl -v --user test:test 'http://127.0.0.1:8000/app.php/books/1'
# get all books
curl -v --user test:test 'http://127.0.0.1:8000/app.php/books/'
# get non-existent resource
curl -v --user test:test 'http://127.0.0.1:8000/app.php/nonexistent/' 
```
## TESTS
```bash
php ./tests/test.php
```