let pattern =[
    {
        name: 'htmlopen',
        match: /^(&lt;\w+)/
    },
    {
        name:"attribute",
        match: /^(\w+)=".+"/
    },
    {
      name:"htmlclosetag",
      match: /^(&gt;)/
    },
    {
        name:"htmlclose",
        match: /^(&lt;\/.+?&gt;)/
    },
    {
        name: 'doublequote',
        match: /^(\"[^\"\n]*\")/
    },
]