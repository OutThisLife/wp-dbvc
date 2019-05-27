#!/bin/bash

# Write certs in env to files and replace with path
if [ -n "$MYSQL_SSL_KEY" -a -n "$MYSQL_SSL_CERT" ]
then
  echo "Custom MySQL client key and cert for X509 auth set"

  if [[ ! "$MYSQL_SSL_KEY" =~ '\.pem$' ]]
  then
    echo "$MYSQL_SSL_KEY" > /app/config/mysql-certs/client-key.pem
    export MYSQL_SSL_KEY="client-key.pem"
  fi

  if [[ ! "$MYSQL_SSL_CERT" =~ '\.pem$' ]]
  then
    echo "$MYSQL_SSL_CERT" > /app/config/mysql-certs/client-cert.pem
    export MYSQL_SSL_CERT="client-cert.pem"
  fi
fi

if [ -n "$MYSQL_SSL_CA" ]
then
  echo "Custom MySQL server root CA set"

  if [[ ! "$MYSQL_SSL_CA" =~ '\.pem$' ]]
  then
    echo "$MYSQL_SSL_CA" > /app/config/mysql-certs/server-ca.pem
    export MYSQL_SSL_CA="server-ca.pem"
  fi
fi

#
# Try and fix file modified times to always be set to slug compile time
#
SLUG_MTIME=$( sed -n -e 's/^Slug Compiled : \(.*\)$/\1/p' web/.heroku-wp | head -n 1 )
if [ -n "$SLUG_MTIME" ]
then
  for ITEM in $( find web )
  do
    #[ -f "$ITEM" ] && touch -m --date="$SLUG_MTIME" "$ITEM"
    [ -f "$ITEM" ]
  done
fi

# Write out boot timestamp
NOW=$( date )
echo "Dyno Booted   : $NOW" >> web/.heroku-wp

# Boot up!
vendor/bin/heroku-php-nginx \
  -C heroku/nginx.inc.conf \
  -F heroku/php-fpm.inc.conf \
  -i heroku/php.ini \
  web/
