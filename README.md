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

    yourtheme > styles > style.css

If you'd like to see where files are that are being tracked, go to the dashboard page. Every less file that Less Compiler picks up will be listed in the order that they will compile.

**NOTE**: Less Compiler *ONLY* looks in the active themes directory!