window.addEventListener('load', () => {
    document.querySelectorAll('[css]')
        .forEach(e => {
            const mixedClassNames = e.getAttribute('css').trim().split(' ')
            mixedClassNames.forEach(mixedClassName => {
                const mixedClass = mixedClasses.filter(m => m.name === mixedClassName)[0]

                if (mixedClass.classes) {
                    mixedClass.classes.forEach(c => e.classList.add(c))
                    e.classList.add(mixedClass.name)
                }

                const style = mixedClass.ownStyle
                if (style)
                    for (let attr in style)
                        e.style[attr] = style[attr]
            })
            e.removeAttribute('css')
        });
})