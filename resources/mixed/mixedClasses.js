function MixedClass(name, classes = [], ownStyle = [])
{
    const classesList = new DOMTokenList();
    [...classes].forEach(c => classesList.add(c));
    classesList.value = classes.join(' ');
    classes = classesList;

    const cssStyle = new CSSStyleDeclaration();
    ownStyle.forEach(rule => {
        if (rule.length !== 2)
            throw new Error(`O valor [${rule.toString()}; é inválido pois deve haver um atributo e um valor!`);
        cssStyle[rule[0]] = rule[1];
    });
    ownStyle = cssStyle;

    return { name, classes, ownStyle }
}

const mixedClasses = [

    {
        name: 'x',
        classes: [
            'container',
            'bg-primary',
            'border'
        ],
        ownStyle: {
            boxShadow: '1px 1px 1px black'
        }
    }

];