describe("Dodawanie książki", () => {
  beforeEach(() => {
    cy.visit("http://localhost/biblioteka/book");
  });

  it("wyświetla formularz dodawania książki i pozwala dodać książkę", () => {
    cy.contains("Dodaj książkę").click();

    cy.get('input[name="title"]').type("Testowa Książka");
    cy.get('select[name="author_id"]').select("43");
    cy.get('input[name="genre"]').type("Fantastyka");
    cy.get('input[name="published_year"]').type("2024");

    cy.get("form").submit();

    cy.contains("Testowa Książka");
  });
});
