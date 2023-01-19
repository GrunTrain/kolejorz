beforeEach(() => {
    cy.visit('/');
});


describe('Load Test', () => {
    it('shows a homepage', () => {
        cy.get('#mapContainer').should('exist')
        cy.get('.leaflet-control-zoom-in').should('exist').click()
        cy.get('.leaflet-control-zoom-out').should('exist').click()
    });
});

describe('Finding station', () => {
    it('Show certian station', () => {
        cy.get('.sidebar > .w-full > .rounded-lg').type('Legnica')
        cy.get(':nth-child(2) > .my-4').contains('Legnica')
        cy.get(':nth-child(3) > .my-4').contains('Legnica Piekary')
    });
});

describe('Should not find station', () => {
    it('Input false data', () => {
        cy.get('.sidebar > .w-full > .rounded-lg').type('isdphjagofi')
        cy.get(':nth-child(2) > .my-4').should('not.exist')
    });
});
describe('Should find station on map', () => {
    it('clicking icon on map', () => {
        cy.get('[d="M125,30053a4,4 0 1,0 8,0 a4,4 0 1,0 -8,0 "]').click()
        cy.get(':nth-child(2) > .my-4').contains('Golda')
        cy.get('.px-1 > img').click()
        cy.get(':nth-child(3) > .my-4').should('exist')
    });
});
describe('Go to login page',() => {
   it('showing login hyperlink', () => {
    cy.get('.fill-current').click()
    cy.get('.static > .w-full').contains('Zaloguj się')
    cy.contains('Zaloguj się').click()
    cy.contains('Login')
    cy.assertRedirect('/login')
   }); 
});

describe('Go to register page',() => {
    it('showing login hyperlink', () => {
     cy.get('.fill-current').click()
     cy.get('.static > .w-full').contains('Dołącz do nas')
     cy.contains('Dołącz do nas').click()
     cy.contains('Rejestracja')
     cy.assertRedirect('/register')
    }); 
 });
 
