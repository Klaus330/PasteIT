class SyntaxHighlither {
    languages = {};

    SyntaxHighlither(){

    }

    getLanguage(name) {
        return this.languages[name];
    }

    setLanguage(name, data) {
        this.languages[name]=data;
    }

    highlight(sourceCode, patternName) {
        let innerHTML = sourceCode.innerHTML;
        let cleanText = this.clean(innerHTML);

        let parsed = this.parse(this.getLanguage(patternName), cleanText);

        parsed = parsed.split('\n').map(function (string, index) {

            if (!index) return string;

            /*
             * Return a new span on the beginning og the line.
             */
            return '<div class="line">' + '<p class="linenum">' + index + '.</p><pre>' + string + '</pre></div>';
        }).join('\n');


        parsed = '<ol class="code">' + parsed + "</ol>";

        sourceCode.innerHTML = parsed;
    }


    parse(patterns, text, output) {
        var match = null;
        var matchType = null;
        var matchPrefix = null;
        var matchSuffix = null;
        output = output || '';

        if (!text.length) return output || '';

        patterns.some(function (pattern) {
            let name = pattern.name;
            let isRegex = pattern.match instanceof RegExp;
            let capture = isRegex ? pattern.match : pattern.match[0];
            let prefix = isRegex ? null : pattern.match[1] || null;
            let suffix = isRegex ? null : pattern.match[2] || null;
            match = text.match(capture);
            matchType = match ? pattern.name : null;
            matchPrefix = prefix;
            matchSuffix = suffix;
            return !!match;
        });

        if (!match) {
            return this.parse(patterns, text.slice(1), output + text[0]);
        } else {
            let replacement = '<span class="' + matchType + '">' + match[1] + '</span>';
            if (matchPrefix) replacement = matchPrefix + replacement;
            if (matchSuffix) replacement = replacement + matchSuffix;

            /*
             * Collect the match and recurse
             */
            return this.parse(patterns, text.slice(match[0].length), output + replacement);
        }
    }

    clean(text) {

        /*
        * Cut out useless new line lines at the front and back.
        * Check to see if there's some indentation and return if not.
        */

        let trimmed = text.replace(/^\n+|\n+\s+$/g, '');
        let spaceToCut = trimmed.match(/^\s+/);

        if (!spaceToCut) return trimmed;

        /*
        * Split the block into an array of lines. For each one, remove the
        * matched indentation from the front.
        */
        var textArray = trimmed.split('\n');
        var dedented = textArray.map(function (string, index) {
            return !string || /^\s+$/.test(string) ? string : string.replace(spaceToCut[0], '');
        }).join('\n');

        /*
         * Spit out the dedented text.
         */
        return '\n' + dedented;
    }
}


