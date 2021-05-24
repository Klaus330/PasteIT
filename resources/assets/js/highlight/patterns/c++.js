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
        match: /^(=>|=|\+|::|-|\*|<|>|=>|<=|\[|\]|!=|!|\.|<<|>>|\&\&|\|\|<|>)/
    }, {
        name: 'keyword',
        match: /^(const|return|switch|case|for|if|else|default|this|type|public|private|protected|int|double|float|boolean|char|std|#include|cin|cout|class|void|using|namespace)\b/
    },  {
        name: 'boolean',
        match: [/^(true|false)/]
    }, {
        name: 'number',
        match: [/^(\d+)/]
    },
    {
        name:"dependency",
        match:/^(\&lt;.+\&gt;)/
    },
    {
        name:"function",
        match:/^([\w\d]+)(\(.*\).*)/
    },
    {
        name:"brackets",
        match: /^(\(.*\))/
    }
];

