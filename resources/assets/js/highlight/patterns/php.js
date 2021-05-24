let pattern = [
    {
        name: 'comment linecomment',
        match: /^(\/\/[^\/\n]*)/
    }, {
        name: 'comment blockcomment',
        match: /^(\/\*(\w+)+\*\/)/
    }, {
        name: 'singlequote',
        match: /^(\'[^\'\n]*\')/
    }, {
        name: 'doublequote',
        match: /^(\"[^\"\n]*\")/
    }, {
        name: 'backquote',
        match: /^(\`[^\`]*`)/
    }, {
        name: 'symbol',
        match: /^(-&gt;|=&gt;|=|\+|::|-|\*|<|>|&&|&lt;=|\[|\]|!=|!|\.|null|\?\?|&lt;\?php|\?&gt;)/
    }, {
        name: 'keyword',
        match: /^(function|return|switch|case|for|if|else|this|public|private|protected|use|class|extends|implements|namespace|new|throw)\b/
    }, {
        name: 'boolean',
        match: [/^(true|false)/]
    }, {
        name: 'number',
        match: [/^(\d+)/]
    }, {
        name: 'destructure',
        match: [/^\{([^\:\}\n]+)\}/, '{', '}']
    },
    {
        name: "variable",
        match: /^(\$[a-zA-z_][a-zA-Z0-9_]+)/
    },
    {
        name:"function",
        match:/^([\w\d]+)(\(.*\).*)/
    },
    {
        name:"brackets",
        match: /^(\(|\))/
    },
    {
        name:"namespace",
        match:/^((?:\\{1,2}\w+|\w+\\{1,2})(?:\w+\\{0,2})+)(.*)/
    }
];

