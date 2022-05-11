const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            cursor: {
                auto: 'auto',
                default: 'default',
                pointer: 'pointer',
            },
        },
        opacity: {
            '0': '0',
           '25': '.25',
           '50': '.5',
           '75': '.75',
           '10': '.1',
           '20': '.2',
           '30': '.3',
           '40': '.4',
           '50': '.5',
           '60': '.6',
           '70': '.7',
           '80': '.8',
           '90': '.9',
            '100': '1',
        },
        container: {
            padding: {
                DEFAULT: '1rem',
                sm: '2rem',
                lg: '4rem',
                xl: '5rem',
                '2xl': '6rem',
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled', 'active'],
            backgroundColor: ['active'],
            cursor: ['hover', 'focus'],
            outline: ['hover', 'active'],
        },
        gridColumn: ['responsive', 'hover'],
        gridColumnStart: ['responsive', 'hover'],
        gridColumnEnd: ['responsive', 'hover'],
        tableLayout: ['hover', 'focus'],
        borderCollapse: ['hover', 'focus'],
    },

    plugins: [require('@tailwindcss/forms')],
};
