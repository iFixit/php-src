The iFixit PHP Interpreter
===================

This is our custom fork of php with a small feature added (autoescaping for html)

Updating to a new version
======================

1. Fetch the origin
2. Create a new branch at the git tag of the php release we want to use, for example `ifixit-production-8.0.2`
3. Cherry-pick the commits that add our feature and update tests
   - Merging can be done too, but there are often far more conflicts
4. Deal with conflicts (usually few)
5. Ensure the copied (and slightly changed) functions in:
    - `Zend/zend_compile.c`
    - `Zend/zend_vm_def.h`
    - `ext/opcache/Optimizer/zend_optimizer.c`
    - `sapi/phpdbg/phpdbg_lexer.l` (if https://github.com/php/php-src/pull/6895 doesn't get merged)
   are just like their copied from counterparts.
6. git add the changes and continue the cherry-pick.
7. run `php Zend/zend_vm_gen.php` and commit the resultant files
8. Build php (using the build script in our infrastructure repo) on this
   branch.
9. Follow these instructions to run tests: https://github.com/php/php-src#testing-php-source-code
10. Open a pull here into the branch you created
