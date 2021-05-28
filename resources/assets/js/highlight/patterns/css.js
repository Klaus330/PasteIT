let pattern = [
    {
        name:"property",
        match:/^(\w+(\-\w+)*?):/
    },
    {
      name:"class",
      match:/^(\.\w+(\-\w+)*?)( ?{)/
    },
    {
        name:"id",
        match:/^(#\w+(\-\w+)*?)( ?{)/

},
    {
        name:"tag",
        match:/^(#\w+(\-\w+)*?):/
    },

    {
        name:"function",
        match:/^([\w\d]+)(\(.*\).*)/
    },
    {
        name:"hexaColor",
        match:/^(#[\w\d]{3,6})/
    }
]