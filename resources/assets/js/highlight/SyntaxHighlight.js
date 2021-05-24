class SyntaxHighlither {
    languages = {};

    SyntaxHighlither() {

    }

    getLanguage(name) {
        return this.languages[name];
    }

    setLanguage(name, data) {
        this.languages[name] = data;
    }

    highlight(sourceCode, patternName) {
        let innerHTML = sourceCode.innerHTML;
        let cleanText = this.clean(innerHTML);

        let parsed = this.parse(this.getLanguage(patternName), cleanText);
        console.log(parsed.split('\n'));
        parsed = parsed.split('\n').map(function (string, index) {

            if (!index && string === "") {
                return string;
            }

            /*
             * Return a new span on the beginning og the line.
             */
            return '<li class="line">' + '<p class="linenum">' + index + '.</p><pre>' + string + '</pre></li>';
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

        let patternFound = patterns.some(function (pattern) {
            let name = pattern.name;
            let isRegex = pattern.match instanceof RegExp;
            let capture = isRegex ? pattern.match : pattern.match[0];

            match = text.match(capture);
            matchType = match ? pattern.name : null;

            return match != null;
        });

        if (!match && !patternFound) {
            return this.parse(patterns, text.slice(1), output + text[0]);
        } else {
            let replacement = '<span class="' + matchType + '">' + match[1] + '</span>';

            /*
             * Collect the match and recurse
             */
            return this.parse(patterns, text.slice(match[1].length), output + replacement);
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


