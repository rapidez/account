import { test, expect } from '@playwright/test'
import { BasePage } from '../../vendor/rapidez/core/tests/playwright/pages/BasePage'
import { RegisterPage } from './pages/RegisterPage'

test.beforeEach(async ({ page }) => {
    await new RegisterPage(page).register()
})

test('overview', async ({ page }) => {
    await page.goto('/account')
    await new BasePage(page).screenshot('fullpage-footer', {
        mask: [await page.getByTestId('masked')],
    })
})

test('edit account', async ({ page }) => {
    await page.goto('/account/edit')
    const input = page.locator('[name=firstname]')
    await expect(input).toHaveValue('Bruce')
    await input.fill('Batman')
    await input.press('Enter')
    await page.waitForLoadState('networkidle')
    await page.reload()
    await expect(input).toHaveValue('Batman')
})

test('addresses', async ({ page }) => {
    await page.goto('/account/address/new')
    await page.fill('[name=firstname]', 'Bruce')
    await page.fill('[name=firstname]', 'Wayne')
    await page.fill('[name=telephone]', '530-7972')
    await page.fill('[name=street]', 'Mountain Drive')
    await page.fill('[name=housenumber]', '1007')
    await page.fill('[name=postcode]', '72000')
    await page.fill('[name=city]', 'Gotham')
    await page.selectOption('[name=country]', 'NL')
    await page.getByTestId('continue').click()
    await page.waitForTimeout(200)
    await page.waitForLoadState('networkidle')

    await page.goto('/account/addresses')
    await page.waitForLoadState('networkidle')
    await expect(page.getByTestId('account-content')).toContainText('Mountain Drive');
})

// TODO:
// account/addresses
// account/address/new
// account/address/{id}
// account/orders
// account/order/{id}
