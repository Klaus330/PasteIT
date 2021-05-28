let pattern = [
    {
        name: "property",
        match: /^(\w+(\-\w+)*?):/
    },
    {
        name: "class",
        match: /^(\.\w+(\-\w+)*?)(::\w+|:\w+)?( |{|,)/
    },
    {
        name: "id",
        match: /^(#\w+(\-\w+)*?)(::\w+|:\w+)?( |{|,)/
    },
    {
        name: "tag",
        match: /^(#\w+(\-\w+)*?):/
    },
    {
        name: "function",
        match: /^([\w\d]+)(\(.*\).*)/
    },
    {
        name: "hexaColor",
        match: /^(#[\w\d]{3,6})/
    },
    {
        name: "specialKeyword",
        match: /^(@\w+)( |{)?/

    },
    {
        name: "keyword",
        match: /^(px|rem|solid|center|wh|absolut|relative|cover|no-repeat|none|flex|grid|column|row|block|transparent|inherit|from|to)/
    },
    {
        name: "attribute",
        match: /^([\w\d]+); /
    },
    {
        name: "number",
        match: /^(\d+)/
    },
    {
        name: "meta",
        match: /^(::\w+|:\w+){?/
    },
    {
        name: "important",
        match: /^(!\w+)/
    }
]