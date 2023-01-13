const { defineConfig } = require('cypress')

module.exports = defineConfig({
    chromeWebSecurity: false,
    retries: 2,
    defaultCommandTimeout: 5000,
    watchForFileChanges: false,
    videosFolder: 'tests/videos',
    screenshotsFolder: 'tests/screenshots',
    fixturesFolder: 'tests/fixture',
    e2e: {
        setupNodeEvents(on, config) {
            return require('./tests/plugins/index.js')(on, config)
        },
        baseUrl: 'http://localhost:8000',
        specPattern: 'tests/integration/**/*.cy.{js,jsx,ts,tsx}',
        supportFile: 'tests/support/index.js',
    },
})
