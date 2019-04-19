# HtmlTable
This code will simplify or improve your work with html tables.

[![Build Status](https://travis-ci.org/AndyDune/HtmlTable.svg?branch=master)](https://travis-ci.org/AndyDune/HtmlTable)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)
[![Packagist Version](https://img.shields.io/packagist/v/andydune/html-table.svg?style=flat-square)](https://packagist.org/packages/andydune/html-table)
[![Total Downloads](https://img.shields.io/packagist/dt/andydune/html-table.svg?style=flat-square)](https://packagist.org/packages/andydune/html-table)


Requirements
------------

PHP version >= 5.6

Installation
------------

Installation using composer:

```
composer require andydune/html-table
```
Or if composer was not installed globally:
```
php composer.phar require andydune/html-table
```
Or edit your `composer.json`:
```
"require" : {
     "andydune/html-table": "^1"
}

```
And execute command:
```
php composer.phar update
```

Example
-----------

Here is small part of code for drawing html table with dynamic data. 

```php
<table class="table authlog">
    <thead>
    <tr>
        <td>ID</td>
        <td>User</td>
        <td>STATUS</td>
        <td>Created</td>
        <td>Updated</td>
        <td>Uploaded</td>
        <td>Link</td>
        <td>Data</td>
        <td></td>
        <td></td>
        <td></td>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($list as $file) {
        ?>
        <tr class="<?= $file->getStatus() == 2 ? 'table-success' : null; ?>">
            <td><?= $file->getId(); ?></td>
            <td><?= $user['EMAIL'] ?> (<?= $user['XML_ID'] ?>)</td>
            <td><?= $showStatus($file->getStatus()); ?></td>
            <td><?= $file->getData('DATETIME'); ?></td>
            <td><?= $file->getData('DATETIME_UPDATE'); ?></td>
            <td><?= $file->getData('DATETIME_LAST_REQUEST'); ?></td>
            <td><?= $file->getFileName(); ?>.<?= $file->getFileType() ?></td>
            <td><? $showArray($file->getMeta()) ?></td>
            <td></td>
            <td>повтор</td>
            <td>удаление</td>
        </tr>
    <?php } ?>
    </tbody>
</table>
```
It simple to accidentally break html by removing single tag. And it is difficult to read and change.

There is better code next down:
```php
use AndyDune\HtmlTable\Builder;
use AndyDune\HtmlTable\Table;

$table = new Table();
$head = $table->head();
$head->cell()->setContent('ID');
$head->cell()->setContent('User');
$head->cell()->setContent('STATUS');
$head->cell()->setContent('Created');
$head->cell()->setContent('Updated');
$head->cell()->setContent('Uploaded');
$head->cell()->setContent('Uploaded');
$head->cell()->setContent('Data');
// Empty cells woll be added automatically depends on max cell count for next rows.
foreach ($list as $file) {
    $row = $table->row();
    if ($file->getStatus() == 2) {
        $row->addClass('table-success')
    }
    $row->cell()->setContent($file->getId());
    $row->cell()->setContent($user['EMAIL'] . $user['XML_ID']);
    $row->cell()->setContent($showStatus($file->getStatus()));
    $row->cell()->setContent($file->getData('DATETIME'));
    $row->cell()->setContent($file->getData('DATETIME_UPDATE'));
    $row->cell()->setContent($file->getData('DATETIME_LAST_REQUEST'));
    $row->cell()->setContent($file->getFileName() . '.' . $file->getFileType());
    $row->cell()->setContent($showArray($file->getMeta()));
}

$buider = new Builder($table);
$builder->setGroupingSections(true);
echo $buider->getHtml(); 
``` 