let pattern =[
    {
        name: 'objectkey',
        match: [/^([^\s\:]+)\:/, '', ':']
    },
    {
        name: 'modulerename',
        match: [/^as\s+([^\s]+)\s+from/, 'as ', ' from']
    }, {
        name: 'modulename',
        match: [/^([A-z_]+)\s+from\b/, '', ' from']
    }, {
        name: 'boolean',
        match: [/^(true|false)/]
    },
    {
        name: "signma string",
        match: /^(\`\w+\`)/
    },
    {
        name: 'singlequote',
        match: /^(\'[^\'\n]*\')/
    }, {
        name: 'doublequote',
        match: /^(\"[^\"\n]*\")/
    }, {
        name: 'backquote',
        match: /^(\`[^\`]*`)/
    },
    {
        name: 'symbol',
        match: /^(=&gt;|=|\+|::|-|\*|&lt;|&gt;|&lt;=|\[|\]|!=|!|\.)/
    }, {
        name: 'keyword',
        match: /^(function|var|let|const|return|switch|case|for|if|else|default|infuse|ensure|reduce|this|type)\b/
    },  {
        name: 'boolean',
        match: [/^(true|false)/]
    },
]