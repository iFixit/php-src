#!/bin/bash

set -exuo pipefail

version="$1"

if [ -z "$version" ]; then
  echo "Usage: ifixit-patch-php.sh <PHP_release_version>"
  exit 1
fi

git fetch --all --tags

git checkout php-$version
git checkout -b ifixit-production-$version

git cherry-pick 26ff44e46fd 7a78de87906

php Zend/zend_vm_gen.php

git add Zend/zend_vm*
git commit -m "Auto-generated files: Update"

echo "Finished patching PHP source"
echo "Push to Github with:"
echo "git push origin ifixit-production-$version"
