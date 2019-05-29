describe('This is my first Cypress test', () => {
    Cypress.Cookies.debug(true)

    it('Openining Student Portal', () => {
        cy.visit('http://localhost/LibraryManagement/index.php')
        
    });

    it('Check Element should be Visble', () => {
        cy.get('.active > .nav-link > .menu-title').should('exist')
        cy.get(':nth-child(2) > .nav-link > .menu-title').should('exist')

    });
    
    it('Check All elements are Visible', () => {
        cy.get('.badge-success > .mdi').should('exist')
        
    });

    it('Click on the Element', () => {
        cy.get(':nth-child(1) > :nth-child(9) > .badge-success > .mdi').click()
        
    });

    it('Check Exist and Update Value', () => {
        cy.get('#book_name').clear()
        cy.get('#book_name').type('ManPreets Self Story')

        cy.get('#author_name').clear()
        cy.get('#author_name').type('The Manpreet')

        cy.get(':nth-child(5) > #publication_name').clear()
        cy.get(':nth-child(5) > #publication_name').type('The Panjab Publiation')

        cy.get(':nth-child(6) > #publication_name').clear()
        cy.get(':nth-child(6) > #publication_name').type('250')

        cy.get('.mr-2').should('exist')
        cy.get('.mr-2').click()
    });
})