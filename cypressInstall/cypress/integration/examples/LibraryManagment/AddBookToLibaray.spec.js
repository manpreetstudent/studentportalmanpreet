describe('This is my first Cypress test', () => {
    Cypress.Cookies.debug(true)

    it('Openining Student Portal', () => {
        cy.visit('http://localhost/LibraryManagement/index.php')
        
    });

    it('Check Element should be Visble', () => {
        cy.get('.active > .nav-link > .menu-title').should('exist')
        cy.get(':nth-child(2) > .nav-link > .menu-title').should('exist')
        cy.get('.mr-2').click()


        cy.get('#book_name').should('exist')
        cy.get('#author_name').should('exist')
        cy.get(':nth-child(3) > #publication_name').should('exist')
        cy.get(':nth-child(4) > #publication_name').should('exist')

    });    
})