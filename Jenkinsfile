pipeline {
    options { timeout(time: 25, unit: 'MINUTES') }
    agent any
    environment {
        CONTAINER_NAME='container'
        ECR_ADDRESS='your_ecr_url'
        CONTAINER_NAME_FRONT='front'
        CONTAINER_NAME_BACK='back'
    }
    stages {
        stage ('Build Back') {
            steps {
                sh "docker build --build-arg arg=.env.example -t $CONTAINER_NAME:back -f ./docker/Dockerfile.staging.backend ."
            }
        }
        stage ('Build Front') {
            steps {
                sh "docker build --build-arg arg=.env.test -t $CONTAINER_NAME:front -f ./docker/Dockerfile.staging.frontend ."
            }
        }
//         stage ('Test') {
//             steps {
//                 // Create network where I will connect all containers
//                 sh "docker network create test"
//                 //Get aws credentials
//                 sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
//                 script {
//                     //withRun command starts the container and doesn't stop it until all inside is executed.
//                     //Commands inside are executed on HOST machine
//                     docker.image("$ECR_ADDRESS:db").withRun("-p 3306:3306 --name=db -itd --network=test") {
//                         docker.image("selenium/standalone-chrome").withRun("-p 4444:4444 --name=selenium -itd --network=test") {
//                             docker.image("$CONTAINER_NAME:front").withRun("-p 3001:80 --name=dvmeal_front -itd --network=test") {
//                                 //We start backend container...
//                                 docker.image("$CONTAINER_NAME:back").withRun("-v /output:/home/backend/tests/_output -p 8001:80 --name=dvmeal_back -itd --network=test") {
//                                     //...and with inside command execute commands *surprise* inside the container
//                                     docker.image("$CONTAINER_NAME:back").inside("-itd --network=test") {
//                                         sh '/home/backend/migration.sh'
//                                         sh "cd /home/backend; php vendor/bin/codecept run acceptance FirstCest.php --debug"
//                                     }
//                                 }
//                             }
//                         }
//                     }
//                 }
//             }
//         }
        stage ('Build Production Back') {
            steps {
                script {
                    //Replace placeholders with environment variables from Jenkins
                    sh 'env > env.txt'
                    sh 'touch ./backend/.env.build'
                    readFile('env.txt').split("\r?\n").each {
                            sh "sed \"s~{${it.split("=")[0]}}~${it.split("=")[1]}~\" ./backend/.env.staging > ./backend/.env.build && mv ./backend/.env.build ./backend/.env.staging"
                    }
                    sh "chmod 777 ./backend/.env.staging && mv ./backend/.env.staging ./backend/.env"
                    sh 'cat ./backend/.env'
                    if (env.GIT_BRANCH == 'origin/master') {
                        sh "docker build --build-arg arg=.env -t $CONTAINER_NAME:back -f ./docker/Dockerfile.staging.backend . "
                    }
                }
            }
        }
        stage ('Build Production Front') {
            steps {
                script {
                    //Replace placeholders with environment variables from Jenkins
                    sh 'env > env.txt'
                    sh 'touch ./backend/.env.build'
                    readFile('env.txt').split("\r?\n").each {
                            sh "sed \"s~{${it.split("=")[0]}}~${it.split("=")[1]}~\" ./backend/.env.staging > ./backend/.env.build && mv ./backend/.env.build ./backend/.env.staging"
                    }
                    sh "chmod 777 ./backend/.env.staging && mv ./backend/.env.staging ./backend/.env"
                    sh 'cat ./backend/.env'
                    if (env.GIT_BRANCH == 'origin/master') {
                        sh "docker build --build-arg arg=.env.staging -t $CONTAINER_NAME:front -f ./docker/Dockerfile.staging.frontend . "
                    }
                }
            }
        }
        stage ('Push Image Back') {
            steps {
                script {
                    if (env.GIT_BRANCH == 'origin/master') {
                        sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
                        sh "docker tag $CONTAINER_NAME:back $ECR_ADDRESS:back"
                        sh "docker push $ECR_ADDRESS:back"
                        sh "echo \"Delete image\""
                        sh "docker image rm -f ${CONTAINER_NAME}:back && docker image prune -f"
                    }
                }
            }
        }
        stage ('Push Image Front') {
            steps {
                script {
                    if (env.GIT_BRANCH == 'origin/master') {
                        sh '$(/root/.local/bin/aws ecr get-login --no-include-email --region eu-central-1)'
                        sh "docker tag $CONTAINER_NAME:front $ECR_ADDRESS:front"
                        sh "docker push $ECR_ADDRESS:front"
                        sh "echo \"Delete image\""
                        sh "docker image rm -f ${CONTAINER_NAME}:front && docker image prune -f"
                    }
                }
            }
        }
        stage('Deploy') {
            steps {
                script {
                    if (env.GIT_BRANCH == 'origin/master') {
                        sshPublisher(publishers: [sshPublisherDesc(configName: 'deploy', transfers: [sshTransfer(cleanRemote: false, excludes: '', execCommand: "\$(aws ecr get-login --no-include-email --region eu-central-1); docker pull ${ECR_ADDRESS}:back; docker pull ${ECR_ADDRESS}:front; docker rm -f ${CONTAINER_NAME_FRONT}; docker rm -f ${CONTAINER_NAME_BACK} ; docker run --name ${CONTAINER_NAME_BACK} -d -p 8003:80 ${ECR_ADDRESS}:back && docker exec -i ${CONTAINER_NAME_BACK} /home/backend/migration.sh && docker run --name ${CONTAINER_NAME_FRONT} -d -p 3002:80 ${ECR_ADDRESS}:front", execTimeout: 120000, flatten: false, makeEmptyDirs: false, noDefaultExcludes: false, patternSeparator: '[, ]+', remoteDirectory: '', remoteDirectorySDF: false, removePrefix: '', sourceFiles: '')], usePromotionTimestamp: false, useWorkspaceInPromotion: false, verbose: false)])
                    }
                }
            }
        }
     }
    post {
        always {
            cleanWs()
            sh 'docker system prune -f'
        }
     }
}