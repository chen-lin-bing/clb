#!/bin/bash

cd /www/clb
git checkout my
git add .
git commit -a -m 'auto'
git checkout develop
git pull origin develop
git merge my
git push oringin develop
git checkout my
