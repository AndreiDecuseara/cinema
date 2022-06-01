const defaultTheme = require('tailwindcss/defaultTheme')
const plugin = require('tailwindcss/plugin')

module.exports = {
  content: [
    './app/**/*.php',
    './resources/**/*.{html,blade.php,js,jsx,ts,tsx,php,vue,twig}',
    './packages/**/*.{html,blade.php,js,jsx,ts,tsx,php,vue,twig}',
    './public/index.html',
  ],
  theme: {
    textColor: theme => theme('colors'),
    extend: {
      colors: {
        primary: '#4B94BE',
        secondary: '#D7EBF3',
        info: '#9AACD0',
        danger: '#E98C8C',
        dark: '#122C32',

        anchor: {
          primary: '#4B94BE',
          secondary: '#D9D9D9',
          info: '#23A5C2',
        },

        gray : {
          'basic': '#E5E7EB',
          'light': '#F9F9F9',
          'faded': '#C4CDD6',
          'dark': '#1B2327BD',
          'icon': '#A2B6C7',
          'tooltip': '#97A5C1'
        },
        black : {
          'light': '#67748E',
          'soft': '#252F40',
          'popover': '#1A1A1AC7',
          'form': '#384F7B'
        },
        blue : {
          'background': '#F6FBFF',
          'light': '#F0F8FB',
          'extra-light': '#F2F8FD',
          'marin': '#4B94BE',
          'dark': '#01385E',
          'dark-lighter': '#37607C',
          'sky': '#D7EBF3',
          'sky-darker': '#D2EEF5',
          'darker': '#122C32',
          'faded': '#78A4C7',
          'widget-text': '#4dbbd9',
          'widget-tooltip': '#EEF7FF',
          'widget-tooltip-text': '#A3C4E1',
          'light-button': '#E9F8FC',
          'badge': '#5BBFDA',
          'info-popover': '#929EB6'
        },
        orange: {
          'dark': '#CB0C9F',
          'light': '#FFE7DA',
          'basic': '#E9773ADE'
        },
        green: {
          'light': '#A1C077',
          'basic': '#E0EBD0'
        },
        purple: {
          'basic': '#DBA8EA'
        }
      },
      screens: {
        'print': {'raw': 'print'},
      },
      width: {
        '72': '18rem',
        '100': '25rem'
      },
      minWidth: {
        '10': '2.5rem'
      },
      minHeight: {
        '10': '2.5rem'
      },
      transitionDuration: {
        '400': '400ms'
      },
      boxShadow: {
        'input': '0px 0px 0px 2px rgba(35, 165, 194, 0.6)'
      },
      fontSize: {
        '15px': '0.938rem'
      },
      margin: {
        '65': '253px'
      },
      borderRadius: {
        '4xl': '30px'
      }
    },
    fontFamily: {
      sans: ['Poppins'],
      serif: ['Poppins'],
      body: ['Poppins']
    },
    fontWeight: {
      hairline: 100,
      thin: 100,
      'extra-light': 200,
      light: 300,
      normal: 400,
      medium: 500,
      semibold: 600,
      bold: 700,
      extrabold: 800,
      'extra-bold': 800,
      black: 900,
    }
  },
  plugins: [
    require('@tailwindcss/custom-forms'),
    plugin(function({ addVariant }) {
      addVariant('important', ({ container }) => {
        container.walkRules(rule => {
          rule.selector = `.\\!${rule.selector.slice(1)}`
          rule.walkDecls(decl => {
            decl.important = true
          })
        })
      })
    }),
  ]
}
