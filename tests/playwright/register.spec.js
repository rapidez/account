import { test, expect } from '@playwright/test'
import { BasePage } from '../../vendor/rapidez/core/tests/playwright/pages/BasePage'
import { RegisterPage } from './pages/RegisterPage'

test('screenshot', async ({ page }) => {
    await page.goto('/register')
    await new BasePage(page).screenshot('fullpage-footer')
})

test('register', async ({ page }) => {
    await new RegisterPage(page).register()
})
