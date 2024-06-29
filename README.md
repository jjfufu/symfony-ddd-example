# Symfony DDD Example

This project serves as a demonstration of implementing Domain-Driven Design (DDD) principles alongside Command Query Responsibility Segregation (CQRS) within a Symfony application. DDD focuses on modeling business domains in software, while CQRS separates read and write operations to optimize performance and scalability.

### Key Components

##### Domain Layer

* Defines core business logic using entities, value objects, and domain services.
* Encapsulates domain behavior and rules specific to the application's business requirements.

##### Application Layer

* Implements CQRS pattern with separate command and query sides.
* Commands handle write operations and modify the application's state.
* Queries handle read operations and retrieve data for presentation.
* Contains application services that orchestrate domain logic and interact with the infrastructure layer.

##### Infrastructure Layer
* Integrates with Symfony framework components such as Doctrine ORM for data persistence.
* Provides infrastructure services in vendor-specific implementations.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `make build` to build fresh images
3. Run `make up` to set up and start a fresh Symfony project
4. Run `make db && make fixtures` to set up database schema and load fixtures
5. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
6. Run `make down` to stop the Docker containers.

## Disclaimer: Utilization of Domain-Driven Design (DDD)

The implementation of Domain-Driven Design (DDD) principles in software development may vary significantly depending on individual approaches and specific project requirements.
