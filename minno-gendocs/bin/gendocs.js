#!/usr/bin/env node
const gendocs = require('../');

if (!module.parent) {
    process.title = 'minno-gendocs';
    gendocs(process.argv[2], process.argv[3]);
} else {
    module.exports = gendocs;
}
