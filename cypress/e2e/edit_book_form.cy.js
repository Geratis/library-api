describe("Formularz edycji książki", () => {
  it("Ładuje formularz, edytuje pola książki i przesyła zmiany", () => {
    const bookId = 55;

    cy.visit(`http://localhost/biblioteka/book/updateBook/${bookId}`);

    cy.get('input[name="title"]').should("exist");
    cy.get('input[name="genre"]').should("exist");
    cy.get('input[name="published_year"]').should("exist");
    cy.get('select[name="author_id"]').should("exist");

    cy.get('input[name="title"]').clear().type("Zaktualizowany tytuł");
    cy.get('select[name="author_id"]').select("45");
    cy.get('input[name="genre"]').clear().type("Nowy gatunek");
    cy.get('input[name="published_year"]').clear().type("2025");

    cy.get("form").submit();
  });
});
