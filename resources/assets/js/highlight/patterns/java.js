let pattern = [
    {
        name: 'keyword',
        match: /^(abstract|assert|boolean|break|case|catch|char|class|const|continue|default|do|double|else|enum|extends|final|finally|float|for|goto|if|implements|import|instanceof|int|interface|long|native|new|package|private|protected|public|return|short|static|super|switch|this|throw|try|void|volatile|while)\b/
    },
    {
        name: 'boolean',
        match: [/^(true|false)/]
    },
    {
        name: 'singlequote',
        match: /^(\'[^\'\n]*\')/
    }, {
        name: 'doublequote',
        match: /^(\"[^\"\n]*\")/
    },
    {
        name: 'symbol',
        match: /^(=&gt;|&lt;=|=|\+|::|-|\*|&lt;|&gt;|\[|\]|!=|!|\.)/
    },
    {
        name: 'number',
        match: [/^(\d+)/]
    },
    {
        name:"function",
        match:/^([\w\d]+)(\(.*\).*)/
    },
    {
        name: 'comment linecomment',
        match: /^(\/\/[^\/\n]*)/
    },
    {
        name: 'comment blockcomment',
        match: /^(\/\*(\w+)+\*\/)/
    }
]