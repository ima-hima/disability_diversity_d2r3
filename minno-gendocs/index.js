const fs = require('fs-extra');
const marked = require('marked');
const path = require('path');
const pkg = fs.readJsonSync('package.json');
const version = pkg.version.replace(/\.[0-9]*$/g, '');
const layout = getLayout();
const playground = fs.readFileSync(__dirname + '/playground.html', 'utf-8');

module.exports = gendocs;

function gendocs(src, dest){
    dest = dest + '/' + version;
    fs.emptyDirSync(dest);
    fs.copySync(__dirname + '/assets', dest + '/assets');
    fs.existsSync('bower_components') && fs.copySync('bower_components', dest + '/bower_components');
    fs.copySync('dist', dest + '/dist');
    fs.copySync('package.json', dest + '/package.json');
    transform(src,dest);
}

function transform(src, dest, menu){
    if (fs.lstatSync(src).isDirectory()) {
        try {menu = fs.readFileSync(src + '/menu.md', 'utf-8');} catch(e){menu = '';}
        fs.ensureDirSync(dest);
        fs.readdirSync(src).forEach(function(filename) {
            transform(src + '/' + filename, dest + '/' + filename, menu);
        });
        return;
    }

    if (/\/menu\.md$/.test(src)) return;
    if (/\.md$/.test(src)) return transformMd(src, dest, menu);
    if (/\.js$/.test(src)) return transformJs(src, dest, menu);
    fs.copySync(src, dest);
}

function getLayout(){
    const minno = pkg.minno;
    const versions = minno.activeVersions && minno.activeVersions.map(v => `<option value="${v}" ${v==version?'selected':''}>v${v}</option>`);
    const select = minno.activeVersions ? `<select id="version-select">${versions}</select>` : '';

    return fs.readFileSync(__dirname + '/layout.html', 'utf-8')
        .replace(/\[quest-version\]/g, minno.questVersion || version)
        .replace(/\[time-version\]/g, minno.timeVersion || version)
        .replace(/\[version-select\]/, select);
}

function transformMd(src, dest, menu){
    var outputFilename = dest.replace(/\.md$/, '.html');
    var markdown = fs.readFileSync(src, 'utf-8');
    var fixed = markdown
        .replace(/<!--[\s\S]*?-->/g,'') // remove html comments
        .replace(/(`[^`]+?)<(.*`)/gim, '$1&lt;$2') // fix generic syntax
        .replace(/`((?:\S| -> |, )+)(\|)(\S+)`/gim, function(match, a, b, c) { // fix pipes in code tags
            return '<code>' + (a + b + c).replace(/\|/g, '&#124;') + '</code>';
        })
        .replace(/(^# .+?(?:\r?\n){2,8}?)(?:(-(?:.|\r|\n)+?)((?:\r?\n){2,})|)/m, function(match, title, nav) { // inject menu
            var file = path.basename(src);
            var link = new RegExp('([ \t]*)(- )(\\[.+?\\]\\(' + file + '\\))');
            var replace = (match, space, li, link) => space + li + '**' + link + '**' + (nav ? '\n' + nav.replace(/(^|\n)/g, '$1\t' + space) : '');
            var modified = menu.replace(link, replace);
            return title + modified + '\n\n';
        })
        .replace(/\.md/gim, '.html') // fix links
        .replace(/\.js/gim, '.html'); // fix links

    var html = layout
        .replace(/\[body\]/, marked(fixed, {renderer:getRenderer()}));

    fs.writeFileSync(outputFilename, html, 'utf-8');
}

function transformJs(src, dest, menu){
    var outputFilename = dest.replace(/\.js$/, '.html');
    var js = fs.readFileSync(src, 'utf-8');
    var filename = path.basename(src);
    var linkRgx = new RegExp('([ \t]*)(- )(\\[(.+?)\\]\\(' + filename + '\\))');
    var boldLink = (match, space, li, title, link) => space + li + '**' + link + '**';
    var modifiedMenu = menu.replace(linkRgx, boldLink);
    var comments = js
        .replace(/(^define|\ndefine)[\s\S]*$/, '')
        .replace(/^\/\//mg, '');

    var markdown = `# ${getTitle()}\n\n${modifiedMenu}\n\n${comments}`
        .replace(/\.md/gim, '.html') // fix links
        .replace(/\.js/gim, '.html'); // fix links

    var body = marked(markdown, {renderer: getRenderer()}) + playground
        .replace(/\[editor\]/, escapeHtml(js))
        .replace(/\[filename\]/, filename);

    var html = layout.replace(/\[body\]/,body);

    fs.writeFileSync(outputFilename, html, 'utf-8');
    fs.copySync(src, dest);

    function getTitle(){
        var match = menu.match(linkRgx);
        return match ? match[3] : filename;
    }

    function escapeHtml(unsafe) {
        return unsafe
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&apos;');
    }
}

function getRenderer(){
    var renderer = new marked.Renderer();

    renderer.heading = function (text, level) {
        // from https://github.com/thlorenz/anchor-markdown-header/blob/master/anchor-markdown-header.js
        var escapedText =  text.replace(/ /g,'-')
            .toLowerCase()
            // escape codes
            .replace(/%([abcdef]|\d){2,2}/ig, '')
            // single chars that are removed
            .replace(/[\/?!:\[\]`.,()*"';{}+=<>~\$|#@]/g,'');

        return [
            '<h' + level + '>',
            '<a name="' + escapedText + '" class="header-link" href="#' + escapedText + '">',
            '<span></span>',
            '</a>',
            text,
            '</h' + level + '>'
        ].join('');
    };

    return renderer;
} 
