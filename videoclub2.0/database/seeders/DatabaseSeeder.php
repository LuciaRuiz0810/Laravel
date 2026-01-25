<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Director;
use App\Models\videoclub_dos;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    private $arrayPeliculas = array(
        array(
            'title' => 'El padrino',
            'year' => '1972',
            'director' => 'Francis Ford Coppola',
            'poster' => "https://m.media-amazon.com/images/M/MV5BZmNiNzM4MTctODI5YS00MzczLWE2MzktNzY4YmNjYjA5YmY1XkEyXkFqcGc@._V1_.jpg",
            'rented' => false,
            'synopsis' => 'Don Vito Corleone (Marlon Brando) es el respetado y temido jefe de una de las cinco familias de la mafia de Nueva York. Tiene cuatro hijos: Connie (Talia Shire), el impulsivo Sonny (James Caan), el pusilánime Freddie (John Cazale) y Michael (Al Pacino), que no quiere saber nada de los negocios de su padre. Cuando Corleone, en contra de los consejos de \'Il consigliere\' Tom Hagen (Robert Duvall), se niega a intervenir en el negocio de las drogas, el jefe de otra banda ordena su asesinato. Empieza entonces una violenta y cruenta guerra entre las familias mafiosas.'
        ),
        array(
            'title' => 'El Padrino. Parte II',
            'year' => '1974',
            'director' => 'Francis Ford Coppola',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMjQ5MzQxZTEtMmE1Yy00NjZlLTk5ODItNjI3MWIxMjk1M2U5XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Continuación de la historia de los Corleone por medio de dos historias paralelas: la elección de Michael Corleone como jefe de los negocios familiares y los orígenes del patriarca, el ya fallecido Don Vito, primero en Sicilia y luego en Estados Unidos, donde, empezando desde abajo, llegó a ser un poderosísimo jefe de la mafia de Nueva York.'
        ),
        array(
            'title' => 'La lista de Schindler',
            'year' => '1993',
            'director' => 'Steven Spielberg',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZTkzMjIwOWUtYmRkZS00ZDdjLThiOTQtNjk4ZmM5NTY1YWI1XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Segunda Guerra Mundial (1939-1945). Oskar Schindler (Liam Neeson), un hombre de enorme astucia y talento para las relaciones públicas, organiza un ambicioso plan para ganarse la simpatía de los nazis. Después de la invasión de Polonia por los alemanes (1939), consigue, gracias a sus relaciones con los nazis, la propiedad de una fábrica de Cracovia. Allí emplea a cientos de operarios judíos, cuya explotación le hace prosperar rápidamente. Su gerente (Ben Kingsley), también judío, es el verdadero director en la sombra, pues Schindler carece completamente de conocimientos para dirigir una empresa.'
        ),
        array(
            'title' => 'Pulp Fiction',
            'year' => '1994',
            'director' => 'Quentin Tarantino',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYTViYTE3ZGQtNDBlMC00ZTAyLTkyODMtZGRiZDg0MjA2YThkXkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'Jules y Vincent, dos asesinos a sueldo con muy pocas luces, trabajan para Marsellus Wallace. Vincent le confiesa a Jules que Marsellus le ha pedido que cuide de Mia, su mujer. Jules le recomienda prudencia porque es muy peligroso sobrepasarse con la novia del jefe. Cuando llega la hora de trabajar, ambos deben ponerse manos a la obra. Su misión: recuperar un misterioso maletín. '
        ),
        array(
            'title' => 'Cadena perpetua',
            'year' => '1994',
            'director' => 'Frank Darabont',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMzdhNGE2ZjAtYjFjYS00YmY2LTg4MDctZTNhN2VlOGM3NjUwXkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'Acusado del asesinato de su mujer, Andrew Dufresne (Tim Robbins), tras ser condenado a cadena perpetua, es enviado a la cárcel de Shawshank. Con el paso de los años conseguirá ganarse la confianza del director del centro y el respeto de sus compañeros de prisión, especialmente de Red (Morgan Freeman), el jefe de la mafia de los sobornos.'
        ),
        array(
            'title' => 'El golpe',
            'year' => '1973',
            'director' => 'George Roy Hill',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZGI4OTk4MDMtYmQ1Ni00YTUzLTkyYTktZGUwMjMyN2M4NjQ5XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Chicago, años treinta. Redford y Newman son dos timadores que deciden vengar la muerte de un viejo y querido colega, asesinado por orden de un poderoso gángster (Robert Shaw). Para ello urdirán un ingenioso y complicado plan con la ayuda de todos sus amigos y conocidos.'
        ),
        array(
            'title' => 'La vida es bella',
            'year' => '1997',
            'director' => 'Roberto Benigni',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNTZhN2IwZWUtNTI2Yy00OWNjLWExZmYtOGMzN2M5NTE1MzM1XkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'En 1939, a punto de estallar la Segunda Guerra Mundial (1939-1945), el extravagante Guido llega a Arezzo (Toscana) con la intención de abrir una librería. Allí conoce a Dora y, a pesar de que es la prometida del fascista Ferruccio, se casa con ella y tiene un hijo. Al estallar la guerra, los tres son internados en un campo de exterminio, donde Guido hará lo imposible para hacer creer a su hijo que la terrible situación que están padeciendo es tan sólo un juego.'
        ),
        array(
            'title' => 'Uno de los nuestros',
            'year' => '1990',
            'director' => 'Martin Scorsese',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BODU5ZjU4NDQtNjQ1My00NDkwLWIyZDItMDgwYjEyZTQ2MGMyXkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Henry Hill, hijo de padre irlandés y madre siciliana, vive en Brooklyn y se siente fascinado por la vida que llevan los gángsters de su barrio, donde la mayoría de los vecinos son inmigrantes. Paul Cicero, el patriarca de la familia Pauline, es el protector del barrio. A los trece años, Henry decide abandonar la escuela y entrar a formar parte de la organización mafiosa como chico de los recados; muy pronto se gana la confianza de sus jefes, gracias a lo cual irá subiendo de categoría. '
        ),
        array(
            'title' => 'Alguien voló sobre el nido del cuco',
            'year' => '1975',
            'director' => 'Milos Forman',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMzZhMGYwNzUtYWU2OS00NGVjLWIwNTAtMmIyNDUxYzY2OGQ2XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Randle McMurphy (Jack Nicholson), un hombre condenado por asalto, y un espíritu libre que vive contracorriente, es recluido en un hospital psiquiátrico. La inflexible disciplina del centro acentúa su contagiosa tendencia al desorden, que acabará desencadenando una guerra entre los pacientes y el personal de la clínica con la fría y severa enfermera Ratched (Louise Fletcher) a la cabeza. La suerte de cada paciente del pabellón está en juego.'
        ),
        array(
            'title' => 'American History X',
            'year' => '1998',
            'director' => 'Tony Kaye',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZTRjMTdkMzctYWI1OS00ZmZkLWJhN2YtOGE3OTVhNTAwZTBhXkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Derek (Edward Norton), un joven "skin head" californiano de ideología neonazi, fue encarcelado por asesinar a un negro que pretendía robarle su furgoneta. Cuando sale de prisión y regresa a su barrio dispuesto a alejarse del mundo de la violencia, se encuentra con que su hermano pequeño (Edward Furlong), para quien Derek es el modelo a seguir, sigue el mismo camino que a él lo condujo a la cárcel.'
        ),
        array(
            'title' => 'Sin perdón',
            'year' => '1992',
            'director' => 'Clint Eastwood',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYTEzOGIwYmEtMDgwNi00M2YwLWE1YmUtOGNiZGNlOGRhMzllXkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'William Munny (Clint Eastwood) es un pistolero retirado, viudo y padre de familia, que tiene dificultades económicas para sacar adelante a su hijos. Su única salida es hacer un último trabajo. En compañía de un viejo colega (Morgan Freeman) y de un joven inexperto (Jaimz Woolvett), Munny tendrá que matar a dos hombres que cortaron la cara a una prostituta.'
        ),
        array(
            'title' => 'El precio del poder',
            'year' => '1983',
            'director' => 'Brian De Palma',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYzE3ZTEyMDItY2YxNy00NDE0LWFmNTUtZTI5YmY3YWZiMzE2XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Tony Montana es un emigrante cubano frío y sanguinario que se instala en Miami con el propósito de convertirse en un gángster importante. Con la colaboración de su amigo Manny Rivera inicia una fulgurante carrera delictiva con el objetivo de acceder a la cúpula de una organización de narcos.'
        ),
        array(
            'title' => 'El pianista',
            'year' => '2002',
            'director' => 'Roman Polanski',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BMjEwNmEwYjgtNTk3ZC00NjljLTg5ZDctZTY3ZGQwZjRkZmQxXkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'Wladyslaw Szpilman, un brillante pianista polaco de origen judío, vive con su familia en el ghetto de Varsovia. Cuando, en 1939, los alemanes invaden Polonia, consigue evitar la deportación gracias a la ayuda de algunos amigos. Pero tendrá que vivir escondido y completamente aislado durante mucho tiempo, y para sobrevivir tendrá que afrontar constantes peligros.'
        ),
        array(
            'title' => 'Seven',
            'year' => '1995',
            'director' => 'David Fincher',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BZDk1NGFlYzItOWUzMi00ZTM4LThhZGYtMDE4M2ZkZDU5OGMxXkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'El veterano teniente Somerset (Morgan Freeman), del departamento de homicidios, está a punto de jubilarse y ser reemplazado por el ambicioso e impulsivo detective David Mills (Brad Pitt). Ambos tendrán que colaborar en la resolución de una serie de asesinatos cometidos por un psicópata que toma como base la relación de los siete pecados capitales: gula, pereza, soberbia, avaricia, envidia, lujuria e ira. Los cuerpos de las víctimas, sobre los que el asesino se ensaña de manera impúdica, se convertirán para los policías en un enigma que les obligará a viajar al horror y la barbarie más absoluta.'
        ),
        array(
            'title' => 'El silencio de los corderos',
            'year' => '1991',
            'director' => 'Jonathan Demme',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BOGZiZjYxY2UtNDE5YS00NzcwLWI0NmItNjcwYThkOWMwYTdhXkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'El FBI busca a "Buffalo Bill", un asesino en serie que mata a sus víctimas, todas adolescentes, después de prepararlas minuciosamente y arrancarles la piel. Para poder atraparlo recurren a Clarice Starling, una brillante licenciada universitaria, experta en conductas psicópatas, que aspira a formar parte del FBI. Siguiendo las instrucciones de su jefe, Jack Crawford, Clarice visita la cárcel de alta seguridad donde el gobierno mantiene encerrado a Hannibal Lecter, antiguo psicoanalista y asesino, dotado de una inteligencia superior a la normal. Su misión será intentar sacarle información sobre los patrones de conducta de "Buffalo Bill".'
        ),
        array(
            'title' => 'La naranja mecánica',
            'year' => '1971',
            'director' => 'Stanley Kubrick',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYjFiN2E5N2ItZjc1Yy00MzZmLThmZGQtNGIyYjljMzk1NmU4XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Gran Bretaña, en un futuro indeterminado. Alex (Malcolm McDowell) es un joven muy agresivo que tiene dos pasiones: la violencia desaforada y Beethoven. Es el jefe de la banda de los drugos, que dan rienda suelta a sus instintos más salvajes apaleando, violando y aterrorizando a la población. Cuando esa escalada de terror llega hasta el asesinato, Alex es detenido y, en prisión, se someterá voluntariamente a una innovadora experiencia de reeducación que pretende anular drásticamente cualquier atisbo de conducta antisocial.'
        ),
        array(
            'title' => 'La chaqueta metálica',
            'year' => '1987',
            'director' => 'Stanley Kubrick',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BYzc3MmRlNzQtY2VmOS00YjJkLWE0NmQtZGE4NDlhYTY3YmQzXkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'Un grupo de reclutas se prepara en Parish Island, centro de entrenamiento de la marina norteamericana. Allí está el sargento Hartman, duro e implacable, cuya única misión en la vida es endurecer el cuerpo y el alma de los novatos, para que puedan defenderse del enemigo. Pero no todos los jóvenes están preparados para soportar sus métodos. '
        ),
        array(
            'title' => 'Blade Runner',
            'year' => '1982',
            'director' => 'Ridley Scott',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNzA1Njg4NzYxOV5BMl5BanBnXkFtZTgwODk5NjU3MzI@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'A principios del siglo XXI, la poderosa Tyrell Corporation creó, gracias a los avances de la ingeniería genética, un robot llamado Nexus 6, un ser virtualmente idéntico al hombre pero superior a él en fuerza y agilidad, al que se dio el nombre de Replicante. Estos robots trabajaban como esclavos en las colonias exteriores de la Tierra. Después de la sangrienta rebelión de un equipo de Nexus-6, los Replicantes fueron desterrados de la Tierra. Brigadas especiales de policía, los Blade Runners, tenían órdenes de matar a todos los que no hubieran acatado la condena. Pero a esto no se le llamaba ejecución, se le llamaba "retiro". '
        ),
        array(
            'title' => 'Taxi Driver',
            'year' => '1976',
            'director' => 'Martin Scorsese',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BNjEzODdkNDgtMGNjMS00MTg3LWIyYTctMzVkYWM4N2I5ZDI0XkEyXkFqcGc@._V1_.jpg',
            'rented' => false,
            'synopsis' => 'Para sobrellevar el insomnio crónico que sufre desde su regreso de Vietnam, Travis Bickle (Robert De Niro) trabaja como taxista nocturno en Nueva York. Es un hombre insociable que apenas tiene contacto con los demás, se pasa los días en el cine y vive prendado de Betsy (Cybill Shepherd), una atractiva rubia que trabaja como voluntaria en una campaña política. Pero lo que realmente obsesiona a Travis es comprobar cómo la violencia, la sordidez y la desolación dominan la ciudad. Y un día decide pasar a la acción.'
        ),
        array(
            'title' => 'El club de la lucha',
            'year' => '1999',
            'director' => 'David Fincher',
            'poster' => 'https://m.media-amazon.com/images/M/MV5BOTgyOGQ1NDItNGU3Ny00MjU3LTg2YWEtNmEyYjBiMjI1Y2M5XkEyXkFqcGc@._V1_.jpg',
            'rented' => true,
            'synopsis' => 'Un joven hastiado de su gris y monótona vida lucha contra el insomnio. En un viaje en avión conoce a un carismático vendedor de jabón que sostiene una teoría muy particular: el perfeccionismo es cosa de gentes débiles; sólo la autodestrucción hace que la vida merezca la pena. Ambos deciden entonces fundar un club secreto de lucha, donde poder descargar sus frustaciones y su ira, que tendrá un éxito arrollador.'
        )
    );

    private $directors = [
        [
            'name' => 'Christopher Nolan',
            'birth_date' => '1970-07-30',
            'nationality' => 'British-American',
            'biography' => 'Christopher Edward Nolan CBE is a British-American film director, producer, and screenwriter. His films have grossed more than $5 billion worldwide, and have garnered 11 Academy Awards from 36 nominations.',
        ],
        [
            'name' => 'Quentin Tarantino',
            'birth_date' => '1963-03-27',
            'nationality' => 'American',
            'biography' => 'Quentin Jerome Tarantino is an American film director, screenwriter, producer, and actor. His films are characterized by nonlinear storylines, satirical subject matter, aestheticization of violence, extended scenes of dialogue, ensemble casts, references to popular culture and a wide variety of other films, soundtracks primarily containing songs and score pieces from the 1960s to the 1980s, and features of neo-noir film.',
        ],
        [
            'name' => 'Martin Scorsese',
            'birth_date' => '1942-11-17',
            'nationality' => 'American',
            'biography' => 'Martin Charles Scorsese is an American film director, producer, screenwriter, and actor. One of the major figures of the New Hollywood era, he is widely regarded as one of the greatest and most influential directors in film history. His films, most of which are dramas, are known for their violence, profanity, and Catholic themes and references.',
        ],
        [
            'name' => 'Steven Spielberg',
            'birth_date' => '1946-12-18',
            'nationality' => 'American',
            'biography' => 'Steven Allan Spielberg is an American film director, producer, and screenwriter. A major figure of the New Hollywood era and pioneer of the modern blockbuster, Spielberg is the most commercially successful director of all time.',
        ],
        [
            'name' => 'Hayao Miyazaki',
            'birth_date' => '1941-01-05',
            'nationality' => 'Japanese',
            'biography' => 'Hayao Miyazaki is a Japanese animator, director, producer, screenwriter, author, and manga artist. A co-founder of Studio Ghibli, he has attained international acclaim as a masterful storyteller and creator of Japanese animated feature films, and is widely regarded as one of the most accomplished filmmakers in the history of animation.',
        ],
        [
            'name' => 'Alfred Hitchcock',
            'birth_date' => '1899-08-13',
            'nationality' => 'British',
            'biography' => 'Sir Alfred Joseph Hitchcock KBE was an English film director, producer, and screenwriter. He is one of the most influential and widely studied filmmakers in the history of cinema. Known as the "Master of Suspense", he directed over 50 feature films in a career spanning six decades.',
        ],
        [
            'name' => 'James Cameron',
            'birth_date' => '1954-08-16',
            'nationality' => 'Canadian',
            'biography' => 'James Francis Cameron CC is a Canadian film director, screenwriter, and producer. A major figure in the post-New Hollywood era, he is considered one of the industry\'s most innovative filmmakers, regularly pushing the boundaries of cinematic capability with his use of novel technologies.',
        ],
        [
            'name' => 'Tim Burton',
            'birth_date' => '1958-08-25',
            'nationality' => 'American',
            'biography' => 'Timothy Walter Burton is an American film director, producer, artist, writer, and animator. He is known for his gothic fantasy and horror films such as Beetlejuice, Edward Scissorhands, The Nightmare Before Christmas, Ed Wood, Sleepy Hollow, Corpse Bride, Sweeney Todd: The Demon Barber of Fleet Street, and Dark Shadows.',
        ],
        [
            'name' => 'Pedro Almodóvar',
            'birth_date' => '1949-09-25',
            'nationality' => 'Spanish',
            'biography' => 'Pedro Almodóvar Caballero is a Spanish film director, screenwriter, and producer. He came to prominence as a film director during La Movida Madrileña, a cultural renaissance that followed the end of Francoist Spain. His films are known for their complex narratives, and they often depict strong women and transgender characters.',
        ],
        [
            'name' => 'Denis Villeneuve',
            'birth_date' => '1967-10-03',
            'nationality' => 'Canadian',
            'biography' => 'Denis Villeneuve OC CQ is a Canadian film director, writer, and producer. He is a four-time recipient of the Canadian Screen Award for Best Direction, for Maelström in 2001, Polytechnique in 2009, Incendies in 2011 and Enemy in 2013.',
        ],
        [
            'name' => 'Guillermo del Toro',
            'birth_date' => '1964-10-09',
            'nationality' => 'Mexican',
            'biography' => 'Guillermo del Toro Gómez is a Mexican filmmaker and author. A recipient of three Academy Awards, three BAFTA Awards, and an Emmy Award, his work has been characterized by a strong connection to fairy tales and horror, with an effort to infuse visual or poetic beauty in the grotesque.',
        ],
        [
            'name' => 'Akira Kurosawa',
            'birth_date' => '1910-03-23',
            'nationality' => 'Japanese',
            'biography' => 'Akira Kurosawa was a Japanese filmmaker and painter who directed 30 films in a career spanning 57 years. He is regarded as one of the most important and influential filmmakers in the history of cinema. Kurosawa displayed a bold, dynamic style, strongly influenced by Western cinema yet distinct from it.',
        ],
        [
            'name' => 'Stanley Kubrick',
            'birth_date' => '1928-07-26',
            'nationality' => 'American',
            'biography' => 'Stanley Kubrick was an American film director, producer, screenwriter, and photographer. Widely considered one of the greatest filmmakers of all time, his films, almost all of which are adaptations of novels or short stories, cover a wide range of genres and are noted for their realism, dark humor, unique cinematography, extensive set designs, and evocative use of music.',
        ],
        [
            'name' => 'Francis Ford Coppola',
            'birth_date' => '1939-04-07',
            'nationality' => 'American',
            'biography' => 'Francis Ford Coppola is an American film director, producer, and screenwriter. He was a central figure in the New Hollywood filmmaking movement of the 1960s and 1970s, and is widely considered one of the greatest filmmakers of all time. He is best known for directing The Godfather trilogy and Apocalypse Now.',
        ],
        [
            'name' => 'Ridley Scott',
            'birth_date' => '1937-11-30',
            'nationality' => 'British',
            'biography' => 'Sir Ridley Scott is a British film director and producer. Following his commercial breakthrough with Alien (1979), his best-known works are the neo-noir dystopian science fiction film Blade Runner (1982), road adventure film Thelma & Louise (1991), historical drama Gladiator (2000), and science fiction film The Martian (2015).',
        ],
        [
            'name' => 'David Fincher',
            'birth_date' => '1962-08-28',
            'nationality' => 'American',
            'biography' => 'David Andrew Leo Fincher is an American film director. Known for his psychological thrillers, his films have received 40 nominations at the Academy Awards, including three for him as Best Director. He also won the Emmy Award for Outstanding Directing for a Drama Series in 2013 for House of Cards.',
        ],
        [
            'name' => 'Wes Anderson',
            'birth_date' => '1969-05-01',
            'nationality' => 'American',
            'biography' => 'Wesley Wales Anderson is an American filmmaker. His films are known for their symmetry, eccentricity and distinctive visual and narrative styles. He was nominated for the Academy Award for Best Original Screenplay for The Royal Tenenbaums (2001), Moonrise Kingdom (2012), and The Grand Budapest Hotel (2014).',
        ],
        [
            'name' => 'George Lucas',
            'birth_date' => '1944-05-14',
            'nationality' => 'American',
            'biography' => 'George Walton Lucas Jr. is an American film director, producer, screenwriter, and entrepreneur. Lucas is best known for creating the Star Wars and Indiana Jones franchises and founding Lucasfilm, LucasArts, and Industrial Light & Magic.',
        ],
        [
            'name' => 'John Lasseter',
            'birth_date' => '1957-01-12',
            'nationality' => 'American',
            'biography' => 'John Alan Lasseter is an American film director, producer, screenwriter, animator, and voice actor. He is the head of animation at Skydance Animation. He was previously the chief creative officer of Pixar Animation Studios, Walt Disney Animation Studios, and Disneytoon Studios.',
        ],
        [
            'name' => 'Clint Eastwood',
            'birth_date' => '1930-05-31',
            'nationality' => 'American',
            'biography' => 'Clinton Eastwood Jr. is an American actor, filmmaker, musician, and politician. After achieving success in the Western TV series Rawhide, he rose to international fame as the "Man with No Name" in Sergio Leone\'s Dollars Trilogy of spaghetti Westerns during the 1960s, and as antihero cop Harry Callahan in the five Dirty Harry films throughout the 1970s and 1980s.',
        ],
    ];

    public function run(): void
    {
        // User::factory(10)->create();

        $this->moviesSeed();
        $this->usersSeed();
        $this->directorsSeed();
    }

    public function moviesSeed()
    {

        $pelicula =  videoclub_dos::query()->delete();

        $this->command->info('Se han eliminado' . $pelicula . 'registros');

        foreach ($this->arrayPeliculas as $pelicula) {
            $p = new videoclub_dos();
            $p->title = $pelicula['title'];
            $p->year = $pelicula['year'];
            $p->director = $pelicula['director'];
            $p->poster = $pelicula['poster'];
            $p->rented = $pelicula['rented'];
            $p->synopsis = $pelicula['synopsis'];
            $p->save();
        }

        $this->command->info('Registros introducidos de nuevo!');
    }

    public function directorsSeed()
    {

        $director =  Director::query()->delete();
        $this->command->info('Se han eliminado' . $director . 'registros');

        foreach ($this->directors as $director) {
            $d = new Director();
            $d->name = $director['name'];
            $d->birth_date = $director['birth_date'];
            $d->nationality = $director['nationality'];
            $d->biography = $director['biography'];
            $d->save();
        }

        $this->command->info('Registros introducidos de nuevo!');
    }


    public function usersSeed()
    {

        $user = User::query()->delete();


        $this->command->info('Se han eliminado' . $user . 'registros de usuarios');

        //Creación usuarios generales
        for ($i = 0; $i < 2; $i++) {
            $user_nuevo = new User;
            $user_nuevo->name = ('user' . $i);
            $user_nuevo->email = ('user' . $i . '@gmail.com');
            $user_nuevo->password = bcrypt('password');
            $user_nuevo->role = (false); //Revisar porque no funciona bien la contraseña
            $user_nuevo->save();
        }

        //Creación del admin
        $user_nuevo = new User;
        $user_nuevo->name = ('admin');
        $user_nuevo->email = ('admin@gmail.com');
        $user_nuevo->password = bcrypt('password');
        $user_nuevo->role = (true);
        $user_nuevo->save();

        $this->command->info('Registros introducidos de nuevo!');
    }
}
