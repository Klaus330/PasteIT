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
        match: /^(-&gt;|=>|=|\+|::|-|\*|<|>|=>|<=|\[|\]|!=|!|\.)/
    }, {
        name: 'keyword',
        match: /^(function|return|switch|case|for|if|else|this|public|private|protected)\b/
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
    }
];

