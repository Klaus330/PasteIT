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
        match: /^(=>|=|\+|::|-|\*|<|>|=>|<=|\[|\]|!=|!|\.)/
    }, {
        name: 'keyword',
        match: /^(function|var|let|const|return|switch|case|for|if|else|default|infuse|ensure|reduce|this|type|public|private|protected)\b/
    }, {
        name: 'modulerename',
        match: [/^as\s+([^\s]+)\s+from/, 'as ', ' from']
    }, {
        name: 'modulename',
        match: [/^([A-z_]+)\s+from\b/, '', ' from']
    }, {
        name: 'boolean',
        match: [/^(true|false)/]
    }, {
        name: 'number',
        match: [/^(\d+)/]
    }, {
        name: 'destructure',
        match: [/^\{([^\:\}\n]+)\}/, '{', '}']
    }, {
        name: 'objectkey',
        match: [/^([^\s\:]+)\:/, '', ':']
    },
    {
        name: 'htmlopen',
        match: /^(&lt;[^\/].+?&gt;)/
    },
    {
        name:"htmlclose",
        match: /^(&lt;\/.+?&gt;)/
    },
    {
      name:"variable",
      match:  /^(\$[a-zA-z_][a-zA-Z0-9_]+)/
    },
    {
        name: "signma string",
        match: /^(\`\w+\`)/
    }
];

