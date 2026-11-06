import { test, expect } from '@playwright/test'
import { BasePage } from '@rapidez/core/tests/playwright/pages/BasePage.js'
import { RegisterPage } from './pages/RegisterPage'

test('screenshot', async ({ page }) => {
    await page.goto('/register')
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'register.png'
    })
})

test('register', async ({ page }) => {
    await new RegisterPage(page).register()
})
