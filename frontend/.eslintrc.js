module.exports = {
  root: true,
  env: {
    node: true,
  },
  extends: [
    'plugin:vue/base',
    'plugin:vue/essential',
    'plugin:vue/recommended',
    'plugin:vue/essential',
    '@vue/standard',
  ],
  plugins: [
    'vue',
    'vuetify',
  ],
  parserOptions: {
    ecmaVersion: 2020,
  },
  rules: {
    'vuetify/grid-unknown-attributes': 'error',
    'vuetify/no-legacy-grid': 'error',
    'vuetify/no-deprecated-classes': 'error',
    'no-console': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'no-debugger': process.env.NODE_ENV === 'production' ? 'warn' : 'off',
    'vue/prop-name-casing': [
      'error',
      'snake_case',
    ],
    'vue/singleline-html-element-content-newline': [
      'error',
      {
        ignoreWhenNoAttributes: true,
        ignoreWhenEmpty: true,
        ignores: [
          'pre',
          'textarea',
        ],
      },
    ],
    'vue/attributes-order': [
      'warn',
      {
        order: [
          'DEFINITION',
          'LIST_RENDERING',
          'CONDITIONALS',
          'RENDER_MODIFIERS',
          'GLOBAL',
          'UNIQUE',
          'TWO_WAY_BINDING',
          'OTHER_DIRECTIVES',
          'OTHER_ATTR',
          'EVENTS',
          'CONTENT',
        ],
      },
    ],
    'vue/no-v-html': 'off',
    'vue/order-in-components': [
      'warn',
      {
        order: [
          'el',
          'name',
          'parent',
          'functional',
          [
            'delimiters',
            'comments',
          ],
          [
            'components',
            'directives',
            'filters',
          ],
          'extends',
          'mixins',
          'inheritAttrs',
          'model',
          [
            'props',
            'propsData',
          ],
          'data',
          'computed',
          'watch',
          'LIFECYCLE_HOOKS',
          'methods',
          [
            'template',
            'render',
          ],
          'renderError',
        ],
      },
    ],
    camelcase: 'off',
    'arrow-parens': [
      'error',
      'as-needed',
    ],
    'linebreak-style': [
      'error',
      'unix',
    ],
    'require-jsdoc': 'error',
    'comma-dangle': [
      'error',
      'always-multiline',
    ],
    'space-before-function-paren': ['error', {
      anonymous: 'never',
      named: 'never',
      asyncArrow: 'always',
    }],
    semi: ['error', 'always'],

    /**
     * @deprecated
     * @TODO Заменить на https://github.com/typescript-eslint/typescript-eslint/blob/master/packages/eslint-plugin/docs/rules/naming-convention.md
     */
    '@typescript-eslint/camelcase': 'off',

    /**
     * Наименование интерфейсов
     *
     * Имя интерфейса должно начинаться с "I"
     */
    '@typescript-eslint/interface-name-prefix': 0,

    /**
     * Разрешить не именованный импорт/экспорт
     */
    'import/export': 0,

    indent: 'off',
    'vue/script-indent': [
      'error',
      2,
      { baseIndent: 1 },
    ],
    '@typescript-eslint/no-non-null-assertion': 'off',
    '@typescript-eslint/no-explicit-any': 'off', /* @TODO Разобраться и подправить в компонентах ошибки */
    'no-explicit-any': 'off', /* @TODO Разобраться и подправить в компонентах ошибки */
    'no-trailing-spaces': 'off',
    'padded-blocks': 'off',
    'no-empty-function': 0, /* @TODO Разобраться и подправить в компонентах ошибки */
  },
  overrides: [
    {
      files: [
        '**/__tests__/*.{j,t}s?(x)',
        '**/tests/unit/**/*.spec.{j,t}s?(x)',
      ],
      env: {
        jest: true,
      },
    },
  ],
};
