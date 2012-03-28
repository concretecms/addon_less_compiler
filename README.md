Less Compiler
-
"LESS extends CSS with dynamic behavior such as variables, mixins, operations and functions. LESS runs on both the client-side (IE 6+, Webkit, Firefox) and server-side, with Node.js and Rhino."
- [LESScss](http://lesscss.org/)

---

**This package** utilizes the [LESSphp library](http://leafo.net/lessphp/) for compiling

Directions
-
1. Create a less DIR in the root of your ***active*** theme
 * Create less files in a working directory pattern relative to your root path
3. Run compile job


**Compiling**

    yourtheme > less > styles > style.less

**becomes**

    files > css > style.css

##API
###`link()`
lessHelper::link() method returns all inputted in link format

    $less = loader::helper('less','less_compiler');
    echo $less->link('test.css','test.less','etc');
renders into

    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/test.css">
    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/etc">
---
###`as string`

Using the object in string context returns the queue.

    $less = loader::helper('less','less_compiler');
    $less->add('derp.less','test.css');
    $less->add('derp.less');
    $less->add('herp.css');
    $less->add('derp.less');
    echo $less;

renders into

    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/derp.css">
    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/test.css">
    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/herp.css">
---
###`invoke`

Invoking the object prints out the queue

    $less = loader::helper('less','less_compiler');
    $less->add('derp.less');
    $less->add('derp.less');
    $less->add('herp.css');
    $less->add('derp.less');
    $less();

renders into

    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/derp.css">
    <link rel="stylesheet" type="text/css" href="http://local.concrete.com/files/CSS/herp.css">
---

If you'd like to see where files are that are being tracked, go to the dashboard page. Every less file that Less Compiler picks up will be listed in the order that they will compile.

**NOTE**: Less Compiler *ONLY* looks in the active themes directory!