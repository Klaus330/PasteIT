let pattern = [
    {
        name: 'comment linecomment',
        match: /^(\/\/[^\/\n]*)/
    }, {
        name: 'comment blockcomment',
        match: /^(\/\*(\w+)+\*\/)/
    },
    {
        name: 'comment hashtag',
        match: /^(#.+)/
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
    }, {
        name: 'symbol',
        match: /^(=>|=|\+|::|-|\*|<|>|=>|<=|\[|\]|!=|!|\.|<<|>>|\&\&|\|\|<|>)/
    }, {
        name: 'keyword',
        match: /^(elif|nonlocal|return|pass|continue|for|if|else|while|with|def|del|try|int|double|float|boolean|char|class|void|using|from|import)\b/
    }, {
        name: 'boolean',
        match: [/^(true|false)/]
    }, {
        name: 'number',
        match: [/^(\d+)/]
    },
    {
        name: "function",
        match: /^([\w\d]+)(\(.*\).*)/
    },
    {
        name: "specialKeyword",
        match: /^(@\w+)/
    }
];

