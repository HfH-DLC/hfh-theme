/**
 * File navigation.js.
 *
 * Handles primary navigation menu
 */
(function() {
    const siteNavigation = document.getElementById('site-navigation');

    // Return early if the navigation don't exist.
    if (!siteNavigation) {
        return;
    }

    const button = siteNavigation.getElementsByTagName('button')[0];

    // Return early if the button don't exist.
    if ('undefined' === typeof button) {
        return;
    }

    const menu = siteNavigation.getElementsByTagName('ul')[0];

    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    if (!menu.classList.contains('nav-menu')) {
        menu.classList.add('nav-menu');
    }

    // Toggle the .toggled class and the aria-expanded value each time the button is clicked.
    button.addEventListener('click', function() {
        siteNavigation.classList.toggle('toggled');

        if (button.getAttribute('aria-expanded') === 'true') {
            button.setAttribute('aria-expanded', 'false');
        } else {
            button.setAttribute('aria-expanded', 'true');
        }
    });

    // Remove the .toggled class and set aria-expanded to false when the user clicks outside the navigation.
    document.addEventListener('click', function(event) {
        const isClickInside = siteNavigation.contains(event.target);

        if (!isClickInside) {
            siteNavigation.classList.remove('toggled');
            button.setAttribute('aria-expanded', 'false');
        }
    });
}());

(function() {
    const menuItems = document.querySelectorAll('#primary-menu li.has-sub-menu');
    for (const menuItem of menuItems) {
        menuItem.querySelector('a').addEventListener("click", function(event) {
            if (this.parentNode.classList.contains("has-sub-menu")) {
                if (this.parentNode.classList.contains("open")) {
                    this.parentNode.classList.remove("open");
                    this.setAttribute('aria-expanded', "false");
                } else {
                    const otherItems = document.querySelectorAll('#primary-menu li.has-sub-menu.open');
                    for (const item of otherItems) {
                        item.classList.remove("open");
                        item.querySelector('a').setAttribute('aria-expanded', "false");
                    }
                    this.parentNode.classList.add("open");
                    this.setAttribute('aria-expanded', "true");
                }
                event.preventDefault();
                return false;
            }
        });
    };
}());