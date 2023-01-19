beforeEach(()=>{
    cy.refreshDatabase();
})
describe('Login test', () => {
    it('Wrong Data', () => {
        cy.visit('/login')
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get('.relative > .p-2').type('asdsadasd')
        cy.get('.bg-yellow-600').click()
        cy.get('.break-words').contains('These credentials do not match our records.').should('exist')
    });
    it('Correct Data', () => {
        cy.visit('/login')
        cy.create('App\\Models\\User',{email:'kekw@example.com',name:'lamo'})
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get('.relative > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/home')
        cy.get('.fill-current').click()
        cy.get('.mt-7 > .flex').click()
        cy.contains('Wyloguj się').click()
        cy.assertRedirect('/login')
    });
});
describe('Register test',() => {
    it('Wrong data input', () => {
        cy.visit('/register')
        cy.get('.flex-col > .mt-8').type('lamo')
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get(':nth-child(3) > .p-2').type('passwrd')
        cy.get(':nth-child(4) > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.get('.break-words').contains('The password must be at least 8 characters.').should('exist')
    });
    it('Email in use', () => {
        cy.visit('/register')
        cy.get('.flex-col > .mt-8').type('lamo')
        cy.get('[type="email"]').type('kekw@example.com')
        cy.get(':nth-child(3) > .p-2').type('password')
        cy.get(':nth-child(4) > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.get('.break-words').contains('The email has already been taken.').should('exist')
    });
    it('shows a homepage', () => {
        cy.seed()
        cy.visit('/register')
        cy.get('.flex-col > .mt-8').type('lmao')
        cy.get('[type="email"]').type('keka@example.com')
        cy.get(':nth-child(3) > .p-2').type('password')
        cy.get(':nth-child(4) > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/login')
        cy.get('[type="email"]').type('keka@example.com')
        cy.get('.relative > .p-2').type('password')
        cy.get('.bg-yellow-600').click()
        cy.assertRedirect('/home')
    });
});
