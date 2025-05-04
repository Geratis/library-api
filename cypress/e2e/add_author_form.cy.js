describe("Dodawanie autora", () => {
  beforeEach(() => {
    cy.visit("http://localhost/biblioteka/author");
  });

  it("wyświetla formularz dodawania autora i pozwala ją dodać", () => {
    cy.contains("Dodaj nowego autora").click();

    cy.get('input[name="first_name"]').type("Jan");
    cy.get('input[name="last_name"]').type("Kowalski");

    cy.get("form").submit();

    cy.contains("Jan Kowalski");
  });
});
