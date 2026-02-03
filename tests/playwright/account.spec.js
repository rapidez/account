import { test, expect } from '@playwright/test'
import { BasePage } from '@rapidez/core/tests/playwright/pages/BasePage.js'
import { ProductPage } from '@rapidez/core/tests/playwright/pages/ProductPage.js'
import { CheckoutPage } from '@rapidez/core/tests/playwright/pages/CheckoutPage.js'
import { RegisterPage } from './pages/RegisterPage'
import { AccountPage } from './pages/AccountPage'

test.beforeEach(async ({ page }) => {
    await new RegisterPage(page).register()
})

test('overview', BasePage.tags, async ({ page }) => {
    await page.goto('/account')

    // Blank account overview page
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'overview-blank.png',
    })
})

test('edit', BasePage.tags, async ({ page }) => {
    await page.goto('/account/edit')
    const input = page.locator('[name=firstname]')
    await expect(input).toHaveValue('Bruce')
    await input.fill('Batman')
    await input.press('Enter')
    await page.waitForLoadState('networkidle')
    await page.reload()
    await expect(input).toHaveValue('Batman')
})

test('addresses', BasePage.tags, async ({ page }) => {
    await page.goto('/account/address/new')
    await page.waitForLoadState('networkidle')

    // Blank new address page
    await new BasePage(page).screenshot('fullpage-footer', { name: 'address-new.png'})

    await page.fill('[name=firstname]', 'Bruce')
    await page.fill('[name=lastname]', 'Wayne')
    await page.fill('[name=telephone]', '530-7972')
    await page.fill('[name=street]', 'Mountain Drive')
    await page.fill('[name=housenumber]', '1007')
    await page.fill('[name=postcode]', '72000')
    await page.fill('[name=city]', 'Gotham')
    await page.selectOption('[name=country]', 'NL')
    await page.getByTestId('continue').click()
    await page.waitForTimeout(200)
    await page.waitForLoadState('networkidle')
    await page.waitForURL('/account/edit')
    await page.waitForLoadState('networkidle')

    await expect(page.getByTestId('account-content')).toContainText('Mountain Drive')

    // Addresses page with 1 additional address
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'address-additional.png',
    })
    await new AccountPage(page).setDefaultAddress()

    // Addresses page with 1 default address
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'address-default.png',
    })
})

test('orders', BasePage.tags, async ({ page }) => {
    const productPage = new ProductPage(page)
    const checkoutPage = new CheckoutPage(page)

    // Place an order
    await productPage.addToCart(process.env.PRODUCT_URL_SIMPLE)
    await checkoutPage.checkout()

    await page.goto('/account/orders')
    await page.waitForLoadState('networkidle')
    await expect(page.getByTestId('order-id')).toBeVisible()

    // Order overview page
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'order-overview.png',
    })
    await page.getByTestId('order-id').click()

    await page.waitForURL('/account/order/*')
    await page.waitForLoadState('networkidle')
    await expect(page.getByTestId('account-content')).toContainText('Bruce');

    // Order detail page
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'order-detail.png',
    })

    await new AccountPage(page).setDefaultAddress()
    await page.goto('/account')

    // Account overview page with addresses and information
    await new BasePage(page).screenshot('fullpage-footer', {
        name: 'overview-filled.png',
    })
})
